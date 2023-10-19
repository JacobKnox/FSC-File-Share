<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentCreateRequest;
use App\Http\Requests\CommentDeleteRequest;
use App\Models\Comment;
use App\Models\File;
// use App\Models\User;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(string $file_id, string $user_id, CommentCreateRequest $request)
    {
        // Try to find the user and the file, redirect back with errors if not found

        // $problems = [];

        // if(File::find($file_id) == null){
        //     array_push($problems, ["Couldn't find file with id ".$file_id]);
        // }

        // if(User::find($user_id) == null){
        //     array_push($problems, ["Couldn't find user with id ".$user_id]);
        // }

        // if(!empty($problems)){
        //     return back()->with(['problems' => $problems]);
        // }

        if(File::find($file_id)?->comments){
            Comment::create([
                'user_id' => $user_id,
                'file_id' => $file_id,
                'content' => $request->validated('content'),
            ]);
        }

        return back();
    }

    /**
     * Update the specified comment in storage.
     */
    public function update(string $id, CommentCreateRequest $request)
    {
        // Need to add error handling here
        Comment::find($id)?->update($request->validated('content'));
        return back();
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(string $id, CommentDeleteRequest $request)
    {
        // Need to add error handling here
        Comment::destroy($id);
        return back();
    }
}
