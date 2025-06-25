<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to view your profile.');
        }

        $userId = $user->id;
        $user = User::find($userId);
        
        return view('Profile.profileView', compact('user'));
    }

    public function update(Request $request)
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to update your profile.');
        }

        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'city' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('profileImage', 'public');
        } else {
            unset($validatedData['image']);
        }

        $user->update($validatedData);
        
        session(['user' => $user]);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }

    public function showEventHistory()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to view your event history.');
        }

        $userId = $user->id;
        $user = User::find($userId);
        $events = $user->events()->latest()->paginate(10);
        
        return view('Profile.eventHistoryView', compact('events'));
    }
}
