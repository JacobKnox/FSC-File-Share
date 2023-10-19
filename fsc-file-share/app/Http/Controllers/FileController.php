<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileCreateRequest;
use App\Http\Requests\FileFilterRequest;
use App\Http\Requests\FileUpdateRequest;
use App\Models\File;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

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
        // Need to add error handling here
        return view('file.show', ['file' => File::findOrFail($id), 'user' => Auth::user()]);
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

    public function like(string $id, string $user)
    {
        // Need to add error handling here
        File::findOrFail($id)->addLike($user);
        return back();
    }

    public function unlike(string $id, string $user)
    {
        // Need to add error handling here
        File::findOrFail($id)->removeLike($user);
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FileUpdateRequest $request, string $id)
    {
        // Need to add error handling here
        File::findOrFail($id)->updateFromInput($request->validated());
        return redirect('/files/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Like::destroy(Like::select('id')->where('file_id', $id)->get());
        Comment::destroy(Comment::select('id')->where('file_id', $id)->get());
        File::destroy($id);
        return redirect('/files');
    }
}
