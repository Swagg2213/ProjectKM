<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToGoogle(string $role)
    {
        session()->flush();

        if ($role === 'event-creator-role') {
            $realRole = 'Pembuat Event';
        } elseif ($role === 'student-role') {
            $realRole = 'Mahasiswa';
        } else {
            $realRole = null;
        }

        if (!$realRole) {
            return redirect()->route('auth.login')->with('error', 'Invalid role specified for Google login.');
        }

        session(['google_signup_role' => $realRole]);
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $roleName = session('google_signup_role');

            if (!$roleName) {
                return redirect()->route('auth.login')->with('error', 'The signup role was not specified.');
            }

            $user = User::where('email', $googleUser->email)->first();
            $role = Role::where('name', $roleName)->first();

            if (!$role) {
                return redirect()->route('auth.login')->with('error', 'Invalid role specified.');
            }

            if ($user) {
                if ($user->role_id !== $role->id) {
                    return redirect()->route('auth.login')->with('error', "This account is already registered as a {$user->role->name}.");
                }
                Auth::login($user);
            } else {
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make(Str::random(24)),
                    'role_id' => $role->id,
                ]);

                Auth::login($newUser);
            }
            
            session()->forget('google_signup_role');

            if (auth()->user()->role->name === 'Admin') {
                session(['user' => auth()->user()]);
                session(['user_role' => auth()->user()->role->name]);
                return redirect()->route('event.approval');
            } else {
                session(['user' => auth()->user()]);
                session(['user_role' => auth()->user()->role->name]);
                return redirect()->route('event.show');
            }

        } catch (\Exception $e) {
            return redirect()->route('auth.login')->with('error', 'Something went wrong with the Google login.');
        }
    }

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
