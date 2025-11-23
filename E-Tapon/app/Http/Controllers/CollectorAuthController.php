<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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

        throw ValidationException::withMessages([
            'email'=>'No existing user in records.',
        ]);
    }

    // FORGOT PASSWORD
    public function showForgotForm()
    {
        return view('auth.collector.forgot');
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
