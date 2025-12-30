<?php

namespace App\Http\Controllers;

use App\Models\CollectorAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\CollectorLoginRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

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

    // Show confirmation before updating password
    public function showForgotConfirm(Request $request)
    {
        $email = $request->query('email');
        $newpassword = $request->query('newpassword');
        $newpassword_confirmation = $request->query('newpassword_confirmation');

        return view('collector.confirm', [
            'confirmMessage' => 'Are you sure you want to reset your password?',
            'confirmRoute' => route('collector.forgot.confirm'),
            'cancelRoute' => route('collector.forgot'),
            'hiddenInputs' => [
                'email' => $email,
                'newpassword' => $newpassword,
                'newpassword_confirmation' => $newpassword_confirmation
            ]
        ]);
    }

    // Handle "Confirm" button - UPDATE PASSWORD
    public function confirmForgot(Request $request)
    {
        // Validation rules
        $rules = [
            'email' => [
                'required',
                'email',
                'max:50',
                'exists:collector_tbl,email'
            ],
            'newpassword' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],
            'newpassword_confirmation' => 'required'
        ];

        // Custom error messages
        $messages = [
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'Email address not found in our records.',
            'newpassword.required' => 'New password is required.',
            'newpassword.min' => 'Password must be at least 8 characters.',
            'newpassword.confirmed' => 'Password confirmation does not match.',
            'newpassword_confirmation.required' => 'Password confirmation is required.'
        ];

        try {
            $validated = $request->validate($rules, $messages);

            // Update password in database
            $updated = DB::table('collector_tbl')
                ->where('email', $validated['email'])
                ->update([
                    'password' => $validated['newpassword']
                ]);

            if (!$updated) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Failed to update password. Please try again.');
            }

            return view('collector.success', [
                'message' => 'Reset Successfully!',
                'redirectRoute' => route('collector.login')
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput($request->except(['newpassword', 'newpassword_confirmation']))
                ->with('error', 'Please check your input.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput($request->except(['newpassword', 'newpassword_confirmation']))
                ->with('error', 'Failed to reset password: ' . $e->getMessage());
        }
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
