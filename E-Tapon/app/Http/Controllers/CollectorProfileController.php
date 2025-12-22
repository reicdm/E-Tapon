<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CollectorProfileController extends Controller
{
    public function showProfile()
    {
        $collector = Auth::guard('collector')->user();

        $profileData = DB::table('collector_tbl as c')
            ->where('c.collector_id', $collector->collector_id)
            ->select(
                'c.collector_id',
                'c.firstname',
                'c.middlename',
                'c.lastname',
                'c.contact_no',
                'c.email',
                DB::raw("CONCAT_WS(' ', c.firstname, COALESCE(c.middlename, ''), c.lastname) as full_name")
            )
            ->first();

        if (!$profileData) {
            return redirect()->route('collector.dashboard')
                ->with('error', 'Profile not found');
        }

        $profile = [
            'full_name' => $profileData->full_name,
            'firstname' => $profileData->firstname ?? 'N/A',
            'middlename' => $profileData->middlename ?? 'N/A',
            'lastname' => $profileData->lastname ?? 'N/A',
            'birthdate' => 'N/A',
            'contact_number' => $profileData->contact_no ?? 'N/A',
            'email' => $profileData->email ?? 'N/A',
            'full_address' => 'N/A',
            'password_display' => '••••••••'
        ];

        return view('collector.profile', compact('profile'));
    }
}
