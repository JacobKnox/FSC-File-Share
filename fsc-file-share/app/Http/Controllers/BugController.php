<?php

namespace App\Http\Controllers;

use App\Http\Requests\BugCreateRequest;
use Illuminate\Http\Request;
use GrahamCampbell\GitHub\Facades\GitHub;

class BugController extends Controller
{
    /**
     * Display a listing of the bugs for admins to see.
     */
    public function index()
    {
        // Page with all the bugs for the admins to see. Has brief info about it, the status, and some options for each bug.
    }

    /**
     * Show the form for creating a new bug.
     */
    public function create()
    {
        return view('bugreport');
    }

    /**
     * Store a newly created bug in storage.
     */
    public function store(BugCreateRequest $request)
    {
        $validatedData = $request->validated();

        // Will need to change this when I get admin dashboard
        // Need to add error handling for this
        GitHub::issues()->create('JacobKnox', 'FSC-File-Share', array('title' => $validatedData['category'] . ': ' . substr($validatedData['actual'], 0, 60 - strlen($validatedData['category'])), 'body' => implode(PHP_EOL, $validatedData)));

        return redirect()->intended('/');
    }

    /**
     * Display the specified bug.
     */
    public function show(string $id)
    {
        // This will be an individual page for a bug that has more detail information about it.
    }

    /**
     * Show the form for editing the specified bug.
     */
    public function edit(string $id)
    {
        // This will be accessible to the user who submitted the bug and admins.
    }

    /**
     * Update the specified bug in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified bug from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
