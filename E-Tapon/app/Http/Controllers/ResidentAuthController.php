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

        $resident = User::where('email', $credentials['email'])->first();

        if (!$resident) {
            return back()->withErrors([
                'email' => 'No account found with this email address.',
            ])->withInput();
        }

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'password' => 'The password you entered is incorrect.',
            ])->withInput();
        }

        $request->session()->regenerate();
        return redirect()->route('resident.dashboard');
    }

    // REGISTER
    public function showRegisterForm()
    {
        $barangays = DB::table('area_tbl')->get();
        return view('auth.resident.register', compact('barangays'));
    }

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

        Log::info('Validation passed');

        $user = User::create([
            'registration_date' => now(),
            'firstname' => $request->first_name,
            'middlename' => $request->middle_name,
            'lastname' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
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

    // FORGOT PASSWORD
    public function showForgotForm()
    {
        return view('auth.resident.forgot');
    }

    public function forgot(Request $request)
    {
        return redirect()->route('resident.success')->with('success', true);
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('resident.login');
    }
}
