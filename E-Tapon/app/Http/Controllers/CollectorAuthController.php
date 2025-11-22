<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CollectorAuthController extends Controller
{
    // LOGIN
    public function showLoginForm()
    {
        return view('auth.collector.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('collector.dashboard');
        }

        return back()->withErrors([
            'email' => 'No matching email found.',
            'password' => 'Incorrect password. Try again.',
        ]);
    }

    // REGISTER
    public function showRegisterForm()
    {
        return view('auth.collector.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $fullName = trim($request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);
        return redirect()->route('collector.dashboard');
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/collector/login');
    }
}
