<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentCreateRequest;
use App\Http\Requests\CommentDeleteRequest;
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
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('file.index', ['files' => File::all()]);
    }

    public function filter(FileFilterRequest $request)
    {
        $criteria = $request->validated();
        
        if(!isset($criteria['tags'])){
            $criteria['tags'] = null;
        }

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('file.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FileCreateRequest $request)
    {
        return redirect('/files/' . File::createFromInput($request, $request->validated())->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('file.show', ['file' => File::findOrFail($id), 'user' => Auth::user()]);
    }

    /**
     * Display the file.
     */
    public function preview(string $id)
    {
        return File::findOrFail($id)->access();
    }

    public function download(string $id)
    {
        return File::findOrFail($id)->download();
    }

    public function like(string $id, string $user)
    {
        File::findOrFail($id)->addLike($user);
        return back();
    }

    public function unlike(string $id, string $user)
    {
        File::findOrFail($id)->removeLike($user);
        return back();
    }

    public function comment(string $id, string $user, CommentCreateRequest $request)
    {
        File::findOrFail($id)->addComment($user, $request->validated());
        return back();
    }

    public function updateComment(string $id, string $comment, CommentCreateRequest $request)
    {
        Comment::findOrFail($comment)->update($request->validated());
        return back();
    }

    public function deleteComment(string $id, string $comment, CommentDeleteRequest $request)
    {
        Comment::destroy($comment);
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FileUpdateRequest $request, string $id)
    {
        $data = $request->validated();
        File::findOrFail($id)->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'comments' => isset($data['comments']) ? 1 : 0,
            'likes' => isset($data['likes']) ? 1 : 0,
            'downloads' => isset($data['downloads']) ? 1 : 0,
            'tags' => json_encode($data['tags']),
        ]);
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
