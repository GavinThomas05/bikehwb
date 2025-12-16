<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show the registration view form
    public function showRegisterForm()
    {
        return view('register');
    }

    // Show the login view form
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle registration form submission
    public function register(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Automatically log in the new user using laravel's web guard
        auth()->guard('web')->login($user); 
        return redirect('/'); // Redirect to homepage
    }

    // Handle login form submission
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        //checks credentials using laravel's web guard
        if (auth()->guard('web')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        // If authentication fails
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Handle user logout
    public function logout(Request $request)
    {
        auth()->guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

