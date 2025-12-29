<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;

class CollectorProfileEditController extends Controller
{
    public function showProfileEdit()
    {
        $collector = Auth::guard('collector')->user();

        // Check if collector is authenticated
        if (!$collector) {
            return redirect()->route('collector.login')
                ->with('error', 'Please login first');
        }

        $profileData = DB::table('collector_tbl')
            ->where('collector_id', $collector->collector_id)
            ->select(
                'collector_id',
                'firstname',
                'middlename',
                'lastname',
                'contact_no',
                'email',
                'password',
                DB::raw("CONCAT_WS(' ', firstname, COALESCE(middlename, ''), lastname) as full_name")
            )
            ->first();

        // Check if profile data exists
        if (!$profileData) {
            return redirect()->route('collector.dashboard')
                ->with('error', 'Profile not found');
        }

        // Generate bullets based on actual password length
        $password_display = str_repeat('•', strlen($profileData->password));

        $profile = [
            'full_name' => $profileData->full_name ?? 'N/A',
            'firstname' => $profileData->firstname ?? '',
            'middlename' => $profileData->middlename ?? '',
            'lastname' => $profileData->lastname ?? '',
            'contact_number' => $profileData->contact_no ?? '',
            'email' => $profileData->email ?? '',
            'password_display' => $password_display
        ];

        return view('collector.profileedit', compact('profile'));
    }

    // Show confirmation before updating profile
    public function showUpdateConfirm(Request $request)
    {
        $collector = Auth::guard('collector')->user();

        $contact_number = $request->query('contact_number');
        $email = $request->query('email');
        $password = $request->query('password');

        return view('collector.confirm', [
            'confirmMessage' => 'Are you sure you want to update your profile?',
            'confirmRoute' => route('collector.profile.confirmUpdate'),
            'cancelRoute' => route('collector.profileedit'),
            'hiddenInputs' => [
                'contact_number' => $contact_number,
                'email' => $email,
                'password' => $password
            ]
        ]);
    }

    // Handle "Confirm" button - UPDATE DATABASE
    public function confirmUpdate(Request $request)
    {
        $collector = Auth::guard('collector')->user();

        // Validation rules based on database schema
        $rules = [
            'contact_number' => [
                'required',
                'string',
                'size:13',
                'regex:/^(09|\+639)\d{9}$/'
            ],
            'email' => [
                'required',
                'email',
                'max:50',
                'unique:collector_tbl,email,' . $collector->collector_id . ',collector_id'
            ]
        ];

        // Add password validation only if provided and not just bullets
        if ($request->filled('password') && !preg_match('/^•+$/', $request->password)) {
            $rules['password'] = [
                'required',
                'string',
                'min:8',
                'max:255'
            ];
        }

        // Custom error messages
        $messages = [
            'contact_number.required' => 'Contact number is required.',
            'contact_number.size' => 'Contact number must be exactly 13 characters.',
            'contact_number.regex' => 'Please enter a valid Philippine mobile number (e.g., 09123456789 or +639123456789).',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email address must not exceed 50 characters.',
            'email.unique' => 'This email address is already taken.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.max' => 'Password must not exceed 255 characters.'
        ];

        try {
            $validated = $request->validate($rules, $messages);

            // Prepare update data
            $updateData = [
                'contact_no' => $validated['contact_number'],
                'email' => $validated['email']
            ];

            // Add password to update if provided and not just bullets
            if ($request->filled('password') && !preg_match('/^•+$/', $request->password)) {
                $updateData['password'] = $validated['password'];
            }

            // Update the collector profile
            $updated = DB::table('collector_tbl')
                ->where('collector_id', $collector->collector_id)
                ->update($updateData);

            // Always return success view after validation passes
            return view('collector.success', [
                'message' => 'Profile Updated Successfully!',
                'redirectRoute' => route('collector.profile')
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Please check your input.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update profile: ' . $e->getMessage());
        }
    }
}
