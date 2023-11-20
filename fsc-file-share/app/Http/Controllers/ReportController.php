<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\ResolveReportRequest;
use App\Models\Comment;
use App\Models\File;
use App\Models\User;
use App\Models\Warning;

class ReportController extends Controller
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
    public function store(StoreReportRequest $request)
    {
        Report::create([
            'reporter' => $request->user()->id,
            'type' => $request->type == "user" ? 0 : 1,
            'reported' => $request->reported_id,
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ResolveReportRequest $request)
    {
        $report = Report::findOrFail($request->report_id);
        $info = $request->validated();
        $reported = null;
        $user = null;
        switch($report->type){
            case(0):
                $reported = User::findOrFail($report->reported);
                $user = $reported;
                break;
            case(1):
                $reported = File::findOrFail($report->reported);
                $user = $reported->user;
                if($info['action'] == 'delete')
                {
                    File::destroy($reported->id);
                }
                break;
            case(2):
                $reported = Comment::findOrFail($report->reported);
                $user = $reported->user;
                if($info['action'] == 'delete')
                {
                    Comment::destroy($reported->id);
                }
                break;
        }
        if($info['warn'])
        {
            Warning::create([
                'user_id' => $user?->id,
                'issuer' => $request->user()?->id,
                'reason' => $info['reason'],
                'days_left' => $info['duration'],
            ]);
        }
        $report->update(['resolved' => 1]);
        return back()->with(['success' => 'Report resolved.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}
