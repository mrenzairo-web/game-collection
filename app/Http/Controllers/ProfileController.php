<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile', ['user' => Auth::user()]);
    }

 public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name'            => 'required|string|max:255',
        'email'           => 'required|email|unique:users,email,' . $user->id,
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = [
        'name'  => $request->name,
        'email' => $request->email,
    ];

    if ($request->hasFile('profile_picture')) {
        if ($user->profile_picture) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_picture);
        }

        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        $data['profile_picture'] = $path;
    }

    \App\Models\User::where('id', $user->id)->update($data);

    return back()->with('success', 'Profile updated successfully!');
}

    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'password' => ['required', 'confirmed', Password::defaults()],
    ]);

    $request->user()->update([
        'password' => Hash::make($request->password),
    ]);

    return back()->with('success', 'Password updated successfully!');
}

public function logout(Request $request)
{
    Auth::logout(); 
    $request->session()->invalidate(); 
    $request->session()->regenerateToken(); 

    return redirect('/login')->with('success', 'Logged out successfully!');
}
}