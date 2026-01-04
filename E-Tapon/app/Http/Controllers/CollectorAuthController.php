<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CollectorAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.collector.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $collector = DB::table('collector_tbl')
            ->where('email', $credentials['email'])
            ->where('password', $credentials['password'])
            ->first();

        if ($collector) {
            Auth::guard('collector')->loginUsingId($collector->collector_id);
            $request->session()->regenerate();
            return redirect()->intended(route('collector.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showForgotForm()
    {
        return view('auth.collector.forgot');
    }

    public function showForgotConfirm(Request $request)
    {
        $rules = [
            'email' => [
                'required',
                'email',
                'exists:collector_tbl,email'
            ],
            'newpassword' => [
                'required',
                'min:8',
                'confirmed'
            ]
        ];

        $messages = [
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'This email address does not exist in our records.',
            'newpassword.required' => 'New password is required.',
            'newpassword.min' => 'Password must be at least 8 characters.',
            'newpassword.confirmed' => 'Passwords do not match.'
        ];

        try {
            $validated = $request->validate($rules, $messages);

            // Update password directly
            $updated = DB::table('collector_tbl')
                ->where('email', $validated['email'])
                ->update([
                    'password' => $validated['newpassword']
                ]);

            if ($updated) {
                return redirect()->route('collector.forgot')
                    ->with('success', 'Password has been changed successfully! You can now login with your new password.');
            }

            return redirect()->back()
                ->with('error', 'Failed to reset password. Please try again.')
                ->withInput($request->only('email'));
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput($request->only('email'));
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('collector')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('collector.login');
    }
}
