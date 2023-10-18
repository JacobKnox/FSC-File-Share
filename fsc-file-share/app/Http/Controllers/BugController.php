<?php

namespace App\Http\Controllers;

use App\Http\Requests\BugCreateRequest;
use Illuminate\Http\Request;
use GrahamCampbell\GitHub\Facades\GitHub;

class BugController extends Controller
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
        return view('bugreport');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BugCreateRequest $request)
    {
        $validatedData = $request->validated();

        GitHub::issues()->create('JacobKnox', 'FSC-File-Share', array('title' => $validatedData['category'] . ': ' . substr($validatedData['actual'], 0, 60 - strlen($validatedData['category'])), 'body' => implode(PHP_EOL, $validatedData)));

        return redirect()->intended('/');
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
