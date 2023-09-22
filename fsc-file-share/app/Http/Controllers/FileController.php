<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileCreateRequest;
use Illuminate\Http\Request;
use App\Models\File;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('file.index', ['files' => File::all()]);
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
        $validatedData = $request->validated();

        $file = File::create([
            'user_id' => $request->user()->id,
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'path' => $validatedData['file'],
            'comments' => isset($validatedData['comments']) ? 1 : 0,
            'likes' => isset($validatedData['likes']) ? 1 : 0,
            'downloads' => isset($validatedData['downloads']) ? 1 : 0,
            'tags' => json_encode($validatedData['tags'])
        ]);
        $file->store($request->file('file'), $request->file('file')->hashName(), 'local');

        return redirect('/');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
