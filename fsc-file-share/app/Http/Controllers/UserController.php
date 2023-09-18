<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Requests\UserCreateRequest;

class UserController extends Controller
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
    public function signup()
    {
        return view('signup');
    }

    /**
     * Show the form for logging in.
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(UserCreateRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create($validatedData);
        $user->password = Hash::make($validatedData['password']);

        $credentials = [
            'username' => $validatedData['username'],
            'password' => $validatedData['password'],
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            # $user->sendEmailVerificationNotification();
            # return redirect('/email/verify');

            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('user.profile', [
            'user' => User::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('user.edit', [
            'user' => User::findOrFail($id)
        ]);
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
    public function destroy(int $id)
    {
        User::destroy($id);
 
        return redirect('/');
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->only('username', 'password'),[
            'username' => ['required', 'exists:users,username'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect('/login')->withErrors($validator->errors());
        }

        $credentials = $validator->valid();

        if (Auth::attempt($credentials)) {
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
}
