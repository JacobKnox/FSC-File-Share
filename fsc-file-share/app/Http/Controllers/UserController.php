<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;

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
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => ['required', Rule::in(['student', 'faculty'])],
            'name' => 'required',
            'id' => 'required|min_digits:7|unique:users,sid',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|ends_with:@flsouthern.edu,@mocs.flsouthern.edu|unique:users,email',
            'pemail' => 'nullable|email|unique:users,pemail',
            'password' => 'required',
            'cpassword' => 'required|same:password',
            'terms' => 'accepted',
            'policy' => 'accepted',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $validatedData = $validator->valid();

        $user = User::create([
            'status' => $validatedData['status'],
            'name' => $validatedData['name'],
            'sid' => intval($validatedData['id']),
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'pemail' => array_key_exists('pemail', $validatedData) ? $validatedData['pemail'] : null,
            'password' => Hash::make($validatedData['password']),
        ]);

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
        return view('profile', [
            'user' => User::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();
 
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
