<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileCreateRequest;
use App\Http\Requests\FileUpdateRequest;
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
        return redirect('/files/' . File::createFromInput($request, $request->validated())->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('file.show', ['file' => File::findOrFail($id)]);
    }

    /**
     * Display the specified resource.
     */
    public function preview(string $id)
    {
        return File::findOrFail($id)->access();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FileUpdateRequest $request, string $id)
    {
        File::findOrFail($id)->update($request->validated());
        return redirect('/files/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        File::destroy($id);
        return redirect('/files');
    }
}
