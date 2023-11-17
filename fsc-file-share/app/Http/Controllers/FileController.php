<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteFileRequest;
use App\Http\Requests\FileCreateRequest;
use App\Http\Requests\FileFilterRequest;
use App\Http\Requests\FileUpdateRequest;
use App\Models\File;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Warning;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;


class FileController extends Controller
{
    /**
     * Display a listing of the files.
     */
    public function index()
    {
        return view('file.index', ['files' => File::all()]);
    }

    /**
     * Display a listing of the files based on user filters.
     */
    public function filter(FileFilterRequest $request)
    {
        $criteria = $request->validated();
        
        if(!isset($criteria['tags'])){
            $criteria['tags'] = null;
        }
        if(!isset($criteria['title'])){
            $criteria['title'] = null;
        }
        if(!isset($criteria['description'])){
            $criteria['description'] = null;
        }

        // This works, but unsure if there is a better way
        return view('file.index', ['files' => File::query()
                                                    ->when($criteria['tags'], function (Builder $query, array $tags) {
                                                        $query->whereJsonContains('tags', $tags);
                                                    })
                                                    ->when($criteria['title'], function (Builder $query, string $title) {
                                                        $query->where('title', 'like', '%'.$title.'%');
                                                    })
                                                    ->when($criteria['description'], function (Builder $query, string $description) {
                                                        $query->where('description', 'like', '%'.$description.'%');
                                                    })
                                                    ->get()]);
    }

    /**
     * Show the form for creating a new file.
     */
    public function create()
    {
        return view('file.create');
    }

    /**
     * Store a newly created file in storage.
     */
    public function store(FileCreateRequest $request)
    {
        return redirect('/files/' . File::createFromInput($request, $request->validated())->id);
    }

    /**
     * Display the specified file.
     */
    public function show(string $id)
    {
        $file = File::findOrFail($id);
        $response = Gate::inspect('view-file', $file);
        return $response->allowed() ? view('file.show', ['file' => $file, 'user' => Auth::user()]) : back()->with('auth_error', $response->message());
    }

    /**
     * Display the file.
     */
    public function preview(string $id)
    {
        // Need to add error handling here
        return File::findOrFail($id)->access();
    }

    /**
     * Force the user's browser to download the file.
     */
    public function download(string $id)
    {
        // Need to add error handling here
        return File::findOrFail($id)->download();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FileUpdateRequest $request, string $id)
    {
        $file = File::findOrFail($id);
        $response = Gate::inspect('update-file', $file);
        return $response->allowed() ? redirect('/files/' . $file->updateFromInput($request->validated())->id) : back()->with('auth_error', $response->message());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteFileRequest $request)
    {
        $file = File::find($request->file_id);
        if($request->user()->checkRoles(['mod', 'admin'], false))
        {
            Warning::create([
                'user_id' => $file->user_id,
                'issuer' => $request->user()->id,
                'reason' => 'Get moderated',
            ]);
        }
        Like::destroy(Like::select('id')->where('file_id', $request->file_id)->get());
        Comment::destroy(Comment::select('id')->where('file_id', $request->file_id)->get());
        File::destroy($request->file_id);
        return redirect('/files');
    }
}
