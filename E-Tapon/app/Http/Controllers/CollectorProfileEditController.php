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

        if (!$profileData) {
            return redirect()->route('collector.dashboard')
                ->with('error', 'Profile not found');
        }

        $password_display = '••••••••';

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

    public function showUpdateConfirm(Request $request)
    {
        $collector = Auth::guard('collector')->user();

        $contact_number = $request->query('contact_number');
        $email = $request->query('email');

        return view('collector.confirm', [
            'confirmMessage' => 'Are you sure you want to update your profile?',
            'confirmRoute' => route('collector.profile.confirmUpdate'),
            'cancelRoute' => route('collector.profileedit'),
            'hiddenInputs' => [
                'contact_number' => $contact_number,
                'email' => $email
            ]
        ]);
    }

    // Handle "Confirm" button - UPDATE DATABASE
    public function confirmUpdate(Request $request)
    {
        $collector = Auth::guard('collector')->user();

        // Validation rules
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

        // Custom error messages
        $messages = [
            'contact_number.required' => 'Contact number is required.',
            'contact_number.size' => 'Contact number must be exactly 13 characters.',
            'contact_number.regex' => 'Please enter a valid Philippine mobile number (e.g., 09123456789 or +639123456789).',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email address must not exceed 50 characters.',
            'email.unique' => 'This email address is already taken.'
        ];

        try {
            $validated = $request->validate($rules, $messages);

            $updateData = [
                'contact_no' => $validated['contact_number'],
                'email' => $validated['email']
            ];

            $updated = DB::table('collector_tbl')
                ->where('collector_id', $collector->collector_id)
                ->update($updateData);

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
