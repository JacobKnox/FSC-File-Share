<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GrahamCampbell\GitHub\Facades\GitHub;
use Github\AuthMethod;

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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'required',
            'intended' => 'required',
            'actual' => 'required',
            'page' => 'required|url',
            'other' => 'nullable',
        ]);

        GitHub::authenticate(env('GITHUB_TOKEN'), env('GITHUB_PASSWORD'), AuthMethod::ACCESS_TOKEN);
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
