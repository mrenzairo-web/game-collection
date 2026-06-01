<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 

class AuthController extends Controller
{
    public function showRegister(){
        return view('register');
    } 

    public function register(Request $request){
        
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed', 
        ]);

      User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'status'   => 'active', // ✅ DAGDAG LANG ITO
    ]);

        return redirect('/login')->with('success', 'Registration successful!');
    }

    public function showLogin(){
        return view('login');
    }

    public function login(Request $request){
        

        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/dashboard')->with('success', 'Login Successful');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials provided.',
        ])->onlyInput('email');

        
    }

    
}