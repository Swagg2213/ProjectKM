<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (auth()->check()) {
            $user = auth()->user();
            session(['user' => $user]);

            if ($user->role->name === 'Admin') {
                return redirect()->route('event.approval')->with('success', 'Welcome back, Admin ' . $user->name . '!');
            } else {
                return redirect()->route('event.show')->with('success', 'Welcome back, ' . $user->name . '!');
            }
        }

        return view('login.loginForm');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            $user = auth()->user();
            session(['user' => $user]);
            session(['user_role' => $user->role->name]);

            if ($user->role->name === 'Admin') {
                return redirect()->route('event.approval')->with('success', 'Welcome back, Admin ' . $user->name . '!');
            } else {
                return redirect()->route('event.show')->with('success', 'Welcome back, ' . $user->name . '!');
            }
        }

        return redirect()->back()
                        ->with('error', 'The provided credentials do not match our records.');
    }

    public function logout()
    {
        auth()->logout();
        session()->flush();
        return redirect()->route('auth.login')->with('message', 'You have been logged out successfully.');
    }
    
}
