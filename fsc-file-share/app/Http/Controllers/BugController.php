<?php

namespace App\Http\Controllers;

use App\Http\Requests\BugCreateRequest;
use App\Http\Requests\DeleteBugRequest;
use App\Http\Requests\PushBugRequest;
use App\Http\Requests\ResolveBugRequest;
use App\Http\Requests\UpdateBugRequest;
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
            return view('bug-report');
        }
        return back()->with('auth_error', $response->message());
    }

    /**
     * Store a newly created bug in storage.
     */
    public function store(BugCreateRequest $request)
    {
        $response = Gate::inspect('create-bug');
        if($response->allowed())
        {
            $validatedData = $request->validated();
            $validatedData['reporter'] = $request->user() ? $request->user()->id : -1;
            Bug::create($validatedData);
            return back()->with('success', 'Thank you for reporting this bug! Your contributions to improving FSC File Share matter.');
        }
        return back()->with('auth_error', $response->message());
    }

    public function push(PushBugRequest $request)
    {
        $response = Gate::inspect('push-bug');
        if($response->allowed())
        {
            Bug::find($request->bug_id)?->pushToGH();
            return back()->with('success', 'This bug has been successfully pushed to GitHub.');
        }
        return back()->with('auth_error', $response->message());
    }

    public function resolve(ResolveBugRequest $request)
    {
        $response = Gate::inspect('resolve-bug');
        if($response->allowed())
        {
            Bug::find($request->bug_id)?->update(['resolved' => 1]);
            return back()->with('success', 'This bug has been marked as resolved.');
        }
        return back()->with('auth_error', $response->message());
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
    public function update(UpdateBugRequest $request)
    {
        $bug = Bug::find($request->bug_id);
        $response = Gate::inspect('update-bug', $bug);
        if($response->allowed())
        {
            $bug?->update($request->validated());
            return back()->with('success', 'Bug report successfully update.');
        }
        return back()->with('auth_error', $response->message());
    }

    /**
     * Remove the specified bug from storage.
     */
    public function destroy(DeleteBugRequest $request)
    {
        $response = Gate::inspect('delete-bug', Bug::find($request->bug_id));
        if($response->allowed())
        {
            Bug::destroy($request->bug_id);
            return back()->with('success', 'Bug report successfully deleted.');
        }
        return back()->with('auth_error', $response->message());
    }
}
