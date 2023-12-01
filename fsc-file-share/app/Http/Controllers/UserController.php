<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordChangeRequest;
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
     * Display a listing of the users.
     */
    public function index()
    {
        return view('user.index', ['users' => User::all()]);
    }

    /**
     * Show the form for creating a new user.
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
     * Store a newly created user in storage.
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
     * Display the specified user.
     */
    public function show(string $id)
    {
        // Need to add error handling here
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(string $id)
    {
        // Need to add error handling here
        return view('user.settings', ['user' => User::findOrFail($id)]);
    }

    /**
     * Update the specified user in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        User::find($id)?->update($request->validated());
        return redirect('/users/' . $id);
    }

    /**
     * Change the users password
     */
    public function changePassword(PasswordChangeRequest $request, string $id)
    {
        User::find($id)?->update(['password' => $request->validated("npassword")]);
        return redirect('/users/' . $id)->with('success', 'Password successfully updated!');
    }

    /**
     * Remove the specified user from storage.
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

    /**
     * Log the user in.
     */
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

    /**
     * Log the user out.
     */
    public function unauthenticate(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
