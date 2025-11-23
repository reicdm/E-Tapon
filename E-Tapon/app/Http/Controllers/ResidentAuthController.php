<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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

        throw ValidationException::withMessages([
            'email' => 'No existing user in records.'
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'area_barangay' => 'required|string',
            'zip_code' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $fullName = trim($request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name);

        $user = User::create([
            'name' => $fullName,
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

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/resident/login');
    }
}
