<?php

namespace App\Http\Controllers;

use App\Models\CollectorAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\CollectorLoginRequest;

class CollectorAuthController extends Controller
{
    // LOGIN
    public function showLoginForm()
    {
        return view('auth.collector.login');
    }

    public function login(CollectorLoginRequest $request)
    {
        $collector = CollectorAuth::where('email', $request['email'])->first();

        if (!$collector) {
            return back()->withErrors([
                'email' => 'No existing user in records.',
            ])->withInput($request->except('password'));
        }

        if ($collector->password !== $request->password) {
            return back()->withErrors([
                'password' => 'Incorrect password.',
            ])->withInput($request->except('password'));
        }

        // Login successful
        Auth::guard('collector')->login($collector);
        $request->session()->regenerate();
        return redirect()->route('collector.dashboard');
    }

    // FORGOT PASSWORD
    public function showForgotForm()
    {
        return view('auth.collector.forgot');
    }

    public function forgot(Request $request)
    {
        return redirect()->route('collector.success')->with('success', true);
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
