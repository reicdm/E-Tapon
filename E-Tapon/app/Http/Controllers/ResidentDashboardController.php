<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResidentDashboardController extends Controller
{
    public function dashboard()
    {
        $upcoming = [
            ['date' => 'October 20, 2025', 'truck' => 'TR-003'],
            ['date' => 'October 22, 2025', 'truck' => 'TR-003'],
            ['date' => 'October 20, 2025', 'truck' => 'TR-003'],
            ['date' => 'October 22, 2025', 'truck' => 'TR-003'],
        ];

        return view('resident.dashboard', compact('upcoming'));
    }

    public function schedule()
    {
        $rawSchedules = collect([
            ['barangay' => 'Barangay 123', 'truck' => 'ABC 1234', 'date' => '2025-09-21', 'status' => 'In Progress'],
            ['barangay' => 'Barangay 123', 'truck' => 'ABC 1234', 'date' => '2025-09-21', 'status' => 'Completed'],
            ['barangay' => 'Barangay 123', 'truck' => 'ABC 1234', 'date' => '2025-09-21', 'status' => 'Pending'],
            ['barangay' => 'Barangay 123', 'truck' => 'ABC 1234', 'date' => '2025-09-22', 'status' => 'In Progress'],
            ['barangay' => 'Barangay 123', 'truck' => 'ABC 1234', 'date' => '2025-09-23', 'status' => 'Completed'],
            ['barangay' => 'Barangay 123', 'truck' => 'ABC 1234', 'date' => '2025-09-23', 'status' => 'Cancelled'],
        ]);

        $schedules = $rawSchedules->groupBy('date');

        return view('resident.schedule', compact('schedules'));
    }

    public function request()
    {
        $requests = [
            ['type' => 'Biodegradable', 'schedule' => 'Oct 30, 2025', 'status' => 'Requested'],
            ['type' => 'Biodegradable', 'schedule' => 'Oct 30, 2025', 'status' => 'Requested'],
            ['type' => 'Biodegradable', 'schedule' => 'Oct 30, 2025', 'status' => 'Requested'],
            ['type' => 'Biodegradable', 'schedule' => 'Oct 30, 2025', 'status' => 'Requested'],
            ['type' => 'Biodegradable', 'schedule' => 'Oct 30, 2025', 'status' => 'Requested'],
        ];

        return view('resident.request', compact('requests'));
    }

    public function showRequestForm()
    {
        return view('resident.request_create');
    }

    public function create(Request $request)
    {
        // POST logic

        return redirect()->route('resident.request')->with('popup_message', 'Request successful! Please wait for the approval.');
    }

    public function profile()
    {
        return view('resident.profile');
    }
}
