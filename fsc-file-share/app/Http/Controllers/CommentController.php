<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentCreateRequest;
use App\Http\Requests\CommentDeleteRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $file_id, string $user_id, CommentCreateRequest $request)
    {
        # Try to find the user and the file, redirect back with errors if not found
        Comment::create([
            'user_id' => $user_id,
            'file_id' => $file_id,
            'content' => $request->validated('content'),
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id, CommentCreateRequest $request)
    {
        Comment::findOrFail($id)->update($request->validated());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, CommentDeleteRequest $request)
    {
        Comment::destroy($id);
        return back();
    }
}
