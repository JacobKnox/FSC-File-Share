<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteFileRequest;
use App\Http\Requests\FileCreateRequest;
use App\Http\Requests\FileFilterRequest;
use App\Http\Requests\FileUpdateRequest;
use App\Models\File;
use App\Models\Warning;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the files.
     */
    public function index()
    {
        $this->authorize('viewAny', File::class);
        return view('file.index', ['files' => File::where('visible', '=', 1)->get()]);
    }

    /**
     * Display a listing of the files based on user filters.
     */
    public function filter(FileFilterRequest $request)
    {
        $this->authorize('filter', File::class);
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
        $this->authorize('create', File::class);
        return view('file.create');
    }

    /**
     * Store a newly created file in storage.
     */
    public function store(FileCreateRequest $request)
    {
        $this->authorize('create', File::class);
        if(Storage::has('public\uploads\\' . $request->file('file')->getClientOriginalName()))
        {
            return back()->with('issues', ['This file already exists.']);
        }
        return redirect('/files/' . File::createFromInput($request, $request->validated())->id);
    }

    /**
     * Display the specified file.
     */
    public function show(int $id)
    {
        $file = File::findOrFail($id);
        $this->authorize('view', $file);
        return view('file.show', ['file' => $file, 'user' => Auth::user()]);
    }

    /**
     * Display the file.
     */
    public function preview(int $id)
    {
        $file = File::findOrFail($id);
        $this->authorize('view', $file);
        return $file->access();
    }

    /**
     * Force the user's browser to download the file.
     */
    public function download(int $id)
    {
        // Need to add error handling here
        return File::findOrFail($id)->download();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FileUpdateRequest $request)
    {
        $file = File::findOrFail($request->file_id);
        $this->authorize('update', $file);
        return redirect('/files/' . $file->updateFromInput($request->validated())->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteFileRequest $request)
    {
        $file = File::findOrFail($request->file_id);
        $this->authorize('delete', $file);
        if(Storage::exists($file->path)){
            Storage::delete($file->path);
        }
        if($request->user()->checkRoles(['mod', 'admin'], false) && $request->user()->id != $file->user_id)
        {
            Warning::create([
                'user_id' => $file->user_id,
                'issuer' => $request->user()->id,
                'reason' => 'Get moderated',
            ]);
        }
        $file->getLikes()->delete();
        $file->getComments()->delete();
        $file->delete();
        return redirect('/files');
    }
}
