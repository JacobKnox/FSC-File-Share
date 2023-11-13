<?php

namespace App\Http\Controllers;

use App\Http\Requests\BugCreateRequest;
use Illuminate\Http\Request;
use App\Models\Bug;
use Illuminate\Support\Facades\Gate;

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
        $response = Gate::inspect('create-bug');
        if($response->allowed())
        {
            return view('bugreport');
        }
        return back()->with('auth_error', $response->message());
    }

    /**
     * Store a newly created bug in storage.
     */
    public function store(BugCreateRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['reporter'] = $request->user() ? $request->user()->id : -1;
        Bug::create($validatedData);
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
