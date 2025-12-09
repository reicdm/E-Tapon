<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Area;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResidentAuthController extends Controller
{
    // Show registration form
    public function showRegisterForm()
    {
        $barangays = DB::table('area_tbl')->get(); // or Area::all() if you have a model
        return view('auth.resident.register', compact('barangays'));
    }

    // Handle registration
    public function register(Request $request)
    {
        Log::info('Registration triggered', $request->all()); // ← ADD THIS

        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today', // because you use <input type="date">
            'email' => 'required|email|unique:user_tbl,email',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'area_barangay' => 'required|exists:area_tbl,brgy_id',
            'zip_code' => 'nullable|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Log::info('Validation passed'); // ← ADD THIS

        $user = User::create([
            'registration_date' => now(),
            'firstname' => $request->first_name,
            'middlename' => $request->middle_name,
            'lastname' => $request->last_name,
            'date_of_birth' => $request->date_of_birth, // Y-m-d from <input type="date">
            'contact_no' => $request->phone_number,
            'email' => $request->email,
            'brgy_id' => $request->area_barangay,
            'zip_code' => $request->zip_code,
            'street_address' => $request->address,
            'password' => bcrypt($request->password),
        ]);

        Log::info('User created', ['user_id' => $user->user_id]); // ← ADD THIS

        Auth::login($user);
        return redirect()->route('resident.dashboard');
    }

    // Show login form
    public function showLoginForm()
    {
        return view('auth.resident.login');
    }

    // Handle login
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
            'email' => 'Invalid credentials or user not found.',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('resident.login');
    }
}
