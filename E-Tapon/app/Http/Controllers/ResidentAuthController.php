<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ResidentAuthController extends Controller
{
    // LOGIN
    public function showLoginForm()
    {
        return view('auth.resident.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('resident.dashboard');
        }

        return back()->withErrors([
            'email' => 'No matching email found.',
            'password' => 'Incorrect password. Try again.',
        ]);
    }

    // REGISTER
    public function showRegisterForm()
    {
        return view('auth.resident.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);
        return redirect()->route('resident.dashboard');
    }

    // FORGOT PASSWORD
    public function showForgotForm()
    {
        return view('auth.resident.forgot');
    }
}
