<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollectorAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.collector.login');
    }

    public function login(Request $request)
    {
        // Login verification logic
        return redirect()->route('collector.dashboard');
    }
}
