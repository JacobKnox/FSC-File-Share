<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
            'status' => 'required',
            'name' => 'required',
            'id' => 'required|min_digits:7|unique:users,sid',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|ends_with:flsouthern.edu|unique:users,email',
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

        # dd($validatedData);

        User::create([
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
 
            return redirect()->intended('/');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'exists:users,username'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }
 
        return back()->withErrors([
            'credentials' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function unauthenticate(Request $request)
    {
        Auth::logout();
        $request->session()->regenerate();

        return redirect()->intended('/');
    }
}
