<?php

namespace App\Http\Controllers;

use App\Models\Request as UserRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;


class ResidentDashboardController extends Controller
{
    // ==== DASHBOARD ====
    public function dashboard()
    {
        $user = Auth::user();
        $brgyId = $user->brgy_id;
        $userId = $user->user_id;

        $requestsCount = DB::table('request_tbl')
            ->where('user_id', $userId)
            ->whereIn('status', ['Pending', 'Assigned'])
            ->count();

        // Get valid day orders for the user's barangay
        $scheduledDayOrders = DB::table('brgysched_tbl')
            ->join('collectorsched_tbl', 'brgysched_tbl.sched_id', '=', 'collectorsched_tbl.sched_id')
            ->where('brgysched_tbl.brgy_id', $brgyId)
            ->pluck('collectorsched_tbl.day_order')
            ->unique()
            ->toArray();

        // Start from TODAY (include today if it's a collection day)
        $nextScheduleDate = null;
        $current = now()->startOfDay();

        // Look up to 3 months ahead
        for ($i = 0; $i < 90; $i++) {
            if (in_array($current->dayOfWeek, $scheduledDayOrders)) {
                $nextScheduleDate = $current->copy();
                break;
            }
            $current->addDay();
        }

        $completedCount = DB::table('record_tbl')
            ->where('brgy_id', $brgyId)
            ->where('status', 'Completed')
            ->count();

        $upcoming = [];

        $start = now()->startOfDay();
        $end = now()->addDays(14);
        $current = clone $start;

        while ($current->lte($end)) {
            $dayOrder = $current->dayOfWeek; // 1=Mon, 2=Tue, ..., 0=Sun

            // Get ALL schedules for this barangay that match this day of week
            $schedules = DB::table('brgysched_tbl')
                ->join('collectorsched_tbl', 'brgysched_tbl.sched_id', '=', 'collectorsched_tbl.sched_id')
                ->where('brgysched_tbl.brgy_id', $brgyId)
                ->where('collectorsched_tbl.day_order', $dayOrder)
                ->select('collectorsched_tbl.license_plate', 'brgysched_tbl.sched_id')
                ->get();

            foreach ($schedules as $schedule) {
                $upcoming[] = [
                    'date' => $current->format('F d, Y'),
                    'truck' => $schedule->license_plate,
                    'sched_id' => $schedule->sched_id, // optional, for debugging
                ];
            }

            $current->addDay();
        }

        $assignedRequests = DB::table('request_tbl')
            ->where('user_id', $userId)
            ->whereIn('status', ['Assigned', 'In Progress'])
            ->where('preferred_date', '>=', now()->toDateString())
            ->orderBy('preferred_date', 'asc')
            ->get();

        foreach ($assignedRequests as $req) {
            $upcoming[] = [
                'date' => \Carbon\Carbon::parse($req->preferred_date)->format('F d, Y'),
                'truck' => $req->license_plate ?? 'TR-003',
            ];
        }

        usort($upcoming, function ($a, $b) {
            return \Carbon\Carbon::parse($a['date']) <=> \Carbon\Carbon::parse($b['date']);
        });
        $upcoming = array_slice($upcoming, 0, 4);

        return view('resident.dashboard', compact(
            'requestsCount',
            'nextScheduleDate',
            'completedCount',
            'upcoming'
        ));
    }

    // ==== SCHEDULE ====
    public function schedule()
    {
        $user = Auth::user();
        $brgyId = $user->brgy_id;

        $scheduledDayOrders = DB::table('brgysched_tbl')
            ->join('collectorsched_tbl', 'brgysched_tbl.sched_id', '=', 'collectorsched_tbl.sched_id')
            ->where('brgysched_tbl.brgy_id', $brgyId)
            ->pluck('collectorsched_tbl.day_order')
            ->unique()
            ->toArray();

        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->addMonths(2)->endOfMonth();
        $scheduleDates = [];
        $current = clone $start;
        while ($current->lte($end)) {
            if (in_array($current->dayOfWeek, $scheduledDayOrders)) {
                $scheduleDates[] = $current->format('Y-m-d');
            }
            $current->addDay();
        }

        $records = DB::table('record_tbl')
            ->join('collectorsched_tbl', 'record_tbl.sched_id', '=', 'collectorsched_tbl.sched_id')
            ->join('area_tbl', 'record_tbl.brgy_id', '=', 'area_tbl.brgy_id')
            ->where('record_tbl.brgy_id', $brgyId)
            ->select(
                'area_tbl.brgy_name as barangay',
                'collectorsched_tbl.license_plate as truck',
                'record_tbl.collection_date as date',
                'record_tbl.status',
                'record_tbl.quantity_kg'
            )
            ->orderBy('record_tbl.collection_date', 'desc')
            ->get()
            ->map(function ($item) {
                $truck = $item->license_plate ?? 'Not assigned';

                if (in_array($item->status, ['In Progress', 'Completed']) && $truck === 'Not assigned') {
                    $truck = 'Assigned Truck';
                }
                return [
                    'barangay' => $item->barangay,
                    'truck' => $item->license_plate ?? 'Not assigned',
                    'date' => $item->date,
                    'status' => $item->status,
                ];
            });

        $schedules = $records->groupBy('date');

        return view('resident.schedule', compact('schedules', 'scheduleDates'));
    }

    // ==== REQUEST ====
    public function request()
    {
        $user = Auth::user();
        $userId = $user->user_id;

        $requests = DB::table('request_tbl')
            ->where('user_id', $userId)
            ->orderBy('request_date', 'desc')
            ->get()
            ->map(function ($item) {
                $truck = $item->license_plate ?? 'Not assigned';

                if (in_array($item->status, ['In Progress', 'Completed']) && $truck === 'Not assigned') {
                    $truck = 'Assigned Truck';
                }
                return [
                    'request_id' => $item->request_id,
                    'type' => $item->waste_type,
                    'quantity' => $item->quantity,
                    'preferred_date' => \Carbon\Carbon::parse($item->preferred_date)->format('M d, Y'),
                    'preferred_time' => \Carbon\Carbon::parse($item->preferred_time)->format('g:i A'),
                    'status' => $item->status,
                    'truck' => $item->license_plate ?: 'Not assigned',
                ];
            });

        return view('resident.request', compact('requests'));
    }

    public function cancelRequest(Request $request, string $requestId)
    {
        $user = Auth::user();

        $record = DB::table('request_tbl')
            ->where('request_id', $requestId)
            ->where('user_id', $user->user_id)
            ->first();

        if (!$record) {
            return redirect()->back()->with('popup_message', 'Request not found.');
        }

        if (!in_array($record->status, ['Pending', 'Assigned'])) {
            return redirect()->back()->with('popup_message', 'Cannot cancel — already in progress or completed.');
        }

        DB::table('request_tbl')
            ->where('request_id', $requestId)
            ->update(['status' => 'Cancelled']);

        return redirect()->route('resident.request')->with('popup_message', 'Request cancelled successfully.');
    }

    public function showRequestForm()
    {
        return view('resident.request_create');
    }


    public function create(Request $request)
    {
        $request->validate([
            'waste_type' => 'required|in:Biodegradable,Non-Biodegradable,Recyclable',
            'pref_date' => 'required|date|after_or_equal:today',
            'pref_time' => 'required',
            'qty' => 'required|numeric|min:0.1',
        ]);

        $user = Auth::user();

        $latest = UserRequest::orderBy('request_id', 'desc')->first();
        $number = $latest ? (int) substr($latest->request_id, 2) + 1 : 1;
        $requestId = 'RQ' . str_pad($number, 4, '0', STR_PAD_LEFT);

        try {
            UserRequest::create([
                'request_id' => $requestId,
                'user_id' => $user->user_id,
                'quantity' => $request->qty,
                'waste_type' => $request->waste_type,
                'preferred_date' => $request->pref_date,
                'preferred_time' => $request->pref_time,
                'request_date' => now()->toDateString(),
                'status' => 'Pending',
                'completion_date' => $request->pref_date,
            ]);

            return redirect()->route('resident.request')
                ->with('popup_message', 'Request successful! Please wait for approval.');
        } catch (QueryException $e) {
            if (str_contains($e->getMessage(), 'A pending or active request already exists')) {
                // Add error to the 'pref_date' and 'pref_time' fields (since conflict is on date+time)
                return redirect()->back()
                    ->withInput()
                    ->withErrors([
                        'pref_date' => 'You already have an active or pending request at this date and time. Please choose another slot.',
                    ]);
            }

            Log::error('Request creation failed: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'pref_date' => 'Unable to create request. Please try again later.',
                ]);
        }
    }

    // ==== PROFILE ====
    public function profile()
    {
        $user = Auth::user();

        $userData = DB::table('user_tbl')
            ->join('area_tbl', 'user_tbl.brgy_id', '=', 'area_tbl.brgy_id')
            ->where('user_tbl.user_id', $user->user_id)
            ->select(
                'user_tbl.firstname',
                'user_tbl.middlename',
                'user_tbl.lastname',
                'user_tbl.date_of_birth',
                'user_tbl.contact_no',
                'user_tbl.email',
                'user_tbl.street_address',
                'area_tbl.brgy_name as area_barangay',
                'user_tbl.zip_code'
            )
            ->first();

        return view('resident.profile', compact('userData'));
    }


    public function editProfile()
    {
        $user = Auth::user();

        $userData = DB::table('user_tbl')
            ->join('area_tbl', 'user_tbl.brgy_id', '=', 'area_tbl.brgy_id')
            ->where('user_tbl.user_id', $user->user_id)
            ->select(
                'user_tbl.user_id',
                'user_tbl.firstname',
                'user_tbl.middlename',
                'user_tbl.lastname',
                'user_tbl.date_of_birth',
                'user_tbl.contact_no',
                'user_tbl.email',
                'user_tbl.street_address',
                'area_tbl.brgy_id as area_barangay_id',
                'area_tbl.brgy_name as area_barangay',
                'user_tbl.zip_code'
            )
            ->first();

        $barangays = DB::table('area_tbl')->get();

        return view('resident.profile-edit', compact('userData', 'barangays'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'phone_number' => 'required|string',
            'email' => 'required|email|unique:user_tbl,email,' . $user->user_id . ',user_id',
        ]);

        DB::table('user_tbl')
            ->where('user_id', $user->user_id)
            ->update([
                'firstname' => $request->first_name,
                'middlename' => $request->middle_name,
                'lastname' => $request->last_name,
                'date_of_birth' => $request->date_of_birth,
                'contact_no' => $request->phone_number,
                'email' => $request->email,
            ]);

        return redirect()->route('resident.profile')->with('success', 'Profile updated successfully!');
    }

    // ==== PASSWORD ====
    public function showChangePasswordForm()
    {
        return view('resident.change_password');
    }

    public function updatePassword(Request $request)
    {

        $user = Auth::user();

        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|string|min:8|confirmed',
        ], [
            'oldpassword.required' => 'Please enter your current password.',
            'newpassword.min' => 'The new password must be at least 8 characters.',
            'newpassword.confirmed' => 'The password confirmation does not match.',
        ]);

        if (!Hash::check($request->oldpassword, $user->password)) {
            return back()->withErrors([
                'oldpassword' => 'The current password you entered is incorrect.',
            ]);
        }

        DB::table('user_tbl')
            ->where('user_id', $user->user_id)
            ->update([
                'password' => Hash::make($request->newpassword)
            ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('resident.login')
            ->with('success', 'Password updated successfully! Please log in with your new password.');
    }

    // ==== ADDRESS ====
    public function showChangeAddressForm()
    {
        $barangays = DB::table('area_tbl')->get();
        return view('resident.change_address', compact('barangays'));
    }


    public function updateAddress(Request $request)
    {
        $request->validate([
            'updated_address' => 'required|string',
            'updated_area' => 'required|exists:area_tbl,brgy_id',
            'updated_zip' => 'nullable|string',
        ]);

        $user = Auth::user();

        try {
            DB::table('user_tbl')
                ->where('user_id', $user->user_id)
                ->update([
                    'street_address' => $request->updated_address,
                    'brgy_id' => $request->updated_area,
                    'zip_code' => $request->updated_zip,
                ]);

            return redirect()->route('resident.profile')
                ->with('success', 'Address updated successfully!');
        } catch (QueryException $e) {
            if (str_contains($e->getMessage(), 'Cannot update address')) {
                // Show error on the form (e.g., under address fields)
                return redirect()->back()
                    ->withInput()
                    ->withErrors([
                        'updated_address' => 'You cannot change your address while you have an active or upcoming collection request.',
                    ]);
            }

            Log::error('Address update failed: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'updated_address' => 'Failed to update address. Please try again.',
                ]);
        }
    }

    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        // Delete user
        DB::table('user_tbl')->where('user_id', $user->user_id)->delete();

        // Log out
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('resident.login')->with('success', 'Account deleted successfully.');
    }
}
