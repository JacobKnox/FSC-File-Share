<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\DeleteCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\File;
use App\Models\User;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(CreateCommentRequest $request)
    {
        // Try to find the user and the file, redirect back with errors if not found
        $issues = [];
        $file = File::find($request->file_id);
        if($file == null){
            array_push($issues, ["Couldn't find file with id ".$request->file_id]);
        }
        if(User::find($request->user_id) == null){
            array_push($issues, ["Couldn't find user with id ".$request->user_id]);
        }
        if(!empty($issues)){
            return back()->with(['issues' => $issues]);
        }
        // Check if the file permits comments, return back with error if not
        if($file?->comments)
        {
            // Create the comment if allowed
            Comment::create([
                'user_id' => $request->user_id,
                'file_id' => $request->file_id,
                'content' => $request->validated('content'),
            ]);
            return back();
        }
        return back()->with('issues', ['This file does not allow comments.']);
    }

    /**
     * Update the specified comment in storage.
     */
    public function update(UpdateCommentRequest $request)
    {
        // Try to find the comment, return an error if it fails
        $comment = Comment::find($request->comment_id);
        if($comment == null)
        {
            return back()->with('issues', ['Could not find comment with id'.$request->comment_id]);
        }
        // Update the comment if they can
        $comment?->update($request->validated('content'));
        return back();
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(DeleteCommentRequest $request)
    {
        // Delete the comment if they can
        Comment::destroy($request->id);
        return back();
    }
}
