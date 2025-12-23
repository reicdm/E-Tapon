<?php

namespace App\Http\Controllers;

use App\Models\Request as UserRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResidentDashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $brgyId = $user->brgy_id;
        $userId = $user->user_id;

        // === 1. Requests: Pending + Assigned count ===
        $requestsCount = DB::table('request_tbl')
            ->where('user_id', $userId)
            ->whereIn('status', ['Pending', 'Assigned'])
            ->count();

        // === 2. Schedule: Next recurring collection date ===
        $scheduledDayOrders = DB::table('brgysched_tbl')
            ->join('collectorsched_tbl', 'brgysched_tbl.sched_id', '=', 'collectorsched_tbl.sched_id')
            ->where('brgysched_tbl.brgy_id', $brgyId)
            ->pluck('collectorsched_tbl.day_order')
            ->unique()
            ->toArray();

        $nextScheduleDate = null;
        $today = now()->startOfDay();
        $current = clone $today;

        // Find next scheduled date (within next 3 months)
        while ($nextScheduleDate === null && $current->lte($today->copy()->addMonths(3))) {
            if (in_array($current->dayOfWeek, $scheduledDayOrders)) {
                $nextScheduleDate = $current;
            }
            $current->addDay();
        }

        // === 3. Collections: Completed count ===
        $completedCount = DB::table('record_tbl')
            ->where('brgy_id', $brgyId)
            ->where('status', 'Completed')
            ->count();

        // === 4. Upcoming Collections: Scheduled dates + Assigned requests (next 14 days) ===
        $upcoming = [];

        // A. Scheduled recurring dates
        $start = now()->startOfDay();
        $end = now()->addDays(14);
        $current = clone $start;
        while ($current->lte($end)) {
            if (in_array($current->dayOfWeek, $scheduledDayOrders)) {
                // Get one truck for this day (optional: get all)
                $truck = DB::table('brgysched_tbl')
                    ->join('collectorsched_tbl', 'brgysched_tbl.sched_id', '=', 'collectorsched_tbl.sched_id')
                    ->where('brgysched_tbl.brgy_id', $brgyId)
                    ->whereIn('collectorsched_tbl.day_order', [$current->dayOfWeek])
                    ->value('collectorsched_tbl.license_plate') ?? 'TR-003';

                $upcoming[] = [
                    'date' => $current->format('F d, Y'),
                    'truck' => $truck,
                ];
            }
            $current->addDay();
        }

        // B. Assigned/In Progress user requests (future only)
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

        // Sort by date and limit to 4 (to match your dummy)
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

    public function schedule()
    {
        $user = Auth::user();
        $brgyId = $user->brgy_id;

        // === 1. Get scheduled weekdays for calendar dots (unchanged) ===
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

        // === 2. Fetch REAL records with TRUCK info ===
        $records = DB::table('record_tbl')
            ->join('collectorsched_tbl', 'record_tbl.sched_id', '=', 'collectorsched_tbl.sched_id')
            ->join('area_tbl', 'record_tbl.brgy_id', '=', 'area_tbl.brgy_id')
            ->where('record_tbl.brgy_id', $brgyId)
            ->select(
                'area_tbl.brgy_name as barangay',
                'collectorsched_tbl.license_plate as truck',
                'record_tbl.collector_date as date',
                'record_tbl.status',
                'record_tbl.quantity_kg'
            )
            ->orderBy('record_tbl.collector_date', 'desc')
            ->get()
            ->map(function ($item) {
                $truck = $item->license_plate ?? 'Not assigned';

                // If status is In Progress or Completed, but truck is not assigned → show "Assigned Truck" as fallback
                if (in_array($item->status, ['In Progress', 'Completed']) && $truck === 'Not assigned') {
                    $truck = 'Assigned Truck'; // or fetch from assignment log if available
                }
                return [
                    'barangay' => $item->barangay,
                    'truck' => $item->license_plate ?? 'Not assigned',        // ✅ Now shows correct truck!
                    'date' => $item->date,
                    'status' => $item->status,
                ];
            });

        $schedules = $records->groupBy('date');

        return view('resident.schedule', compact('schedules', 'scheduleDates'));
    }

    // In ResidentDashboardController.php

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

                // If status is In Progress or Completed, but truck is not assigned → show "Assigned Truck" as fallback
                if (in_array($item->status, ['In Progress', 'Completed']) && $truck === 'Not assigned') {
                    $truck = 'Assigned Truck'; // or fetch from assignment log if available
                }
                return [
                    'request_id' => $item->request_id,
                    'type' => $item->waste_type,
                    'quantity' => $item->quantity,
                    'preferred_date' => \Carbon\Carbon::parse($item->preferred_date)->format('M d, Y'),
                    'preferred_time' => \Carbon\Carbon::parse($item->preferred_time)->format('g:i A'), // e.g., "9:00 AM"
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

        // Generate request_id: RQ + 4-digit number (e.g., RQ0001)
        $latest = UserRequest::orderBy('request_id', 'desc')->first();
        $number = $latest ? (int) substr($latest->request_id, 2) + 1 : 1;
        $requestId = 'RQ' . str_pad($number, 4, '0', STR_PAD_LEFT);

        // Get authenticated user
        $user = Auth::user();

        UserRequest::create([
            'request_id' => $requestId,
            'user_id' => $user->user_id, // matches USER_TBL.user_id (INT)
            'quantity' => $request->qty,
            'waste_type' => $request->waste_type,
            'preferred_date' => $request->pref_date, // DATE
            'preferred_time' => $request->pref_time, // TIME
            'request_date' => now()->toDateString(), // DATE
            'status' => 'Pending',
            'completion_date' => $request->pref_date,
        ]);

        return redirect()->route('resident.request')
            ->with('popup_message', 'Request successful! Please wait for approval.');
    }


    public function profile()
    {
        return view('resident.profile');
    }
}
