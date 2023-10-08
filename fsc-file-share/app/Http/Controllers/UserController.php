<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\File;
use App\Models\Like;
use App\Models\Comment;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserDeleteRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.index', ['users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function signup()
    {
        return view('user.signup');
    }

    /**
     * Show the form for logging in.
     */
    public function login()
    {
        return view('user.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(UserCreateRequest $request)
    {
        if (User::createFromInput($request->validated())) {
            $request->session()->regenerate();
            # $user->sendEmailVerificationNotification();
            # return redirect('/email/verify');


        }

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('user.edit', ['user' => User::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        User::findOrFail($id)->update($request->validated());
        return redirect('/users/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserDeleteRequest $request, int $id)
    {
        $options = $request->validated();
        if(isset($options['likes']) && $options['likes']){
            Like::destroy(Like::select('id')->where('user_id', $id)->get());
        }
        if(isset($options['comments']) && $options['comments']){
            Comment::destroy(Comment::select('id')->where('user_id', $id)->get());
        }
        if(isset($options['files']) && $options['files']){
            File::destroy(File::select('id')->where('user_id', $id)->get());
        }
        User::destroy($id);
        return redirect('/');
    }

    public function authenticate(UserLoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return redirect('/login')->withErrors([
            'credentials' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function unauthenticate(Request $request)
    {
        Auth::logout();
        $request->session()->regenerate();
        return redirect('/');
    }

    public function settings(string $id){
        return view('user.settings', ['user' => User::findOrFail($id)]);
    }
}
