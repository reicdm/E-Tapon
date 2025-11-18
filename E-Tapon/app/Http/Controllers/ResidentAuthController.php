<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResidentAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.resident.login');
    }

    public function login(Request $request)
    {
        // Login verification logic
        return redirect()->route('resident.dashboard');
    }
}
