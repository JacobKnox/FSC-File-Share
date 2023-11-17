<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLikeRequest;
use App\Http\Requests\DeleteLikeRequest;
use App\Models\File;
use App\Models\Like;
use App\Models\User;

class LikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLikeRequest $request)
    {
        $file = File::find($request->file_id);
        $user = User::find($request->user_id);
        $issues = [];
        if($file == null)
        {
            array_push($issues, ['Could not find file with id '.$request->file_id]);
        }
        if($user == null)
        {
            array_push($issues, ['Could not find user with id '.$request->user_id]);
        }
        if(!empty($issues))
        {
            return back()->with('issues', $issues);
        }
        if($file?->likes)
        {
            Like::create(['file_id' => $file->id, 'user_id' => $user->id]);
            $file->count_likes += 1;
            $file->save();
            return back();
        }
        return back()->with('issues', ['This file does not permit likes.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteLikeRequest $request)
    {
        $file = File::find($request->file_id);
        Like::where(['file_id' => $file->id, 'user_id' => $request->user_id])->delete();
        $file->count_likes -= 1;
        $file->save();
        return back();
    }
}
