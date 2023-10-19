<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Comment;
use App\Models\File;

class RedirectIfNotUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user() == null){
            return back();//->with(['problems' => ["You're not logged in!"]]);
        }
        
        if($request->user() == User::find($request->user_id) || $request->user() == Comment::find($request->comment_id)?->user || $request->user() == File::find($request->file_id)?->user){
            return $next($request);
        }
        
        return back();//->with(['problems' => ["Hey, that's not your account!"]]);
    }
}
