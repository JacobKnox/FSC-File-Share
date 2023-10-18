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
        if(Auth::user() == null){
            return back();
        }
        
        if(Auth::user() == User::find($request->user_id) || Auth::user() == Comment::find($request->comment_id)?->user || Auth::user() == File::find($request->file_id)?->user){
            return $next($request);
        }
        
        return back();
    }
}
