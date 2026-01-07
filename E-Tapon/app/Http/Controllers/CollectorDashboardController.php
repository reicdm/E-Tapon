<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class CollectorDashboardController extends Controller
{
    public function showOverview()
    {
        $collector = Auth::guard('collector')->user();
        $today = now()->format('l'); // Get current day name
        $todayDate = now()->toDateString();

        // Insert scheduled collections into record_tbl if they don't exist
        DB::table('brgysched_tbl as bs')
            ->join('collectorsched_tbl as cs', 'bs.sched_id', '=', 'cs.sched_id')
            ->where('cs.collector_id', $collector->collector_id)
            ->where('cs.collection_day', $today)
            ->whereNotExists(function ($query) use ($todayDate) {
                $query->select(DB::raw(1))
                    ->from('record_tbl as r')
                    ->whereColumn('r.sched_id', '=', 'bs.sched_id')
                    ->whereColumn('r.brgy_id', '=', 'bs.brgy_id')
                    ->whereDate('r.collection_date', $todayDate);
            })
            ->select('bs.sched_id', 'bs.brgy_id')
            ->get()
            ->each(function ($schedule) use ($todayDate) {
                DB::table('record_tbl')->insert([
                    'sched_id' => $schedule->sched_id,
                    'brgy_id' => $schedule->brgy_id,
                    'collection_date' => $todayDate,
                    'status' => 'Assigned',
                    'quantity_kg' => 0.00
                ]);
            });

        // TODAY'S SCHEDULE - Scheduled collections for today
        $scheduledCollections = DB::table('brgysched_tbl as bs')
            ->join('collectorsched_tbl as cs', 'bs.sched_id', '=', 'cs.sched_id')
            ->join('area_tbl as a', 'bs.brgy_id', '=', 'a.brgy_id')
            ->join('truck_tbl as t', 'cs.license_plate', '=', 't.license_plate')
            ->join('record_tbl as r', function ($join) use ($todayDate) {
                $join->on('bs.sched_id', '=', 'r.sched_id')
                    ->on('bs.brgy_id', '=', 'r.brgy_id')
                    ->whereDate('r.collection_date', $todayDate);
            })
            ->where('cs.collector_id', $collector->collector_id)
            ->where('cs.collection_day', $today)
            ->select(
                'a.brgy_name',
                't.license_plate',
                'r.status',
                DB::raw('NOW() as date'),
                DB::raw('"Scheduled" as type'),
                DB::raw('NULL as waste_type'),
                DB::raw('NULL as quantity')
            );

        // TODAY'S ASSIGNED REQUESTS
        $assignedRequests = DB::table('request_tbl as req')
            ->join('user_tbl as u', 'req.user_id', '=', 'u.user_id')
            ->join('area_tbl as a', 'u.brgy_id', '=', 'a.brgy_id')
            ->where('req.collector_id', $collector->collector_id)
            ->whereDate('req.preferred_date', $todayDate)
            ->whereIn('req.status', ['Assigned', 'In Progress'])
            ->select(
                'a.brgy_name',
                'req.license_plate',
                'req.status',
                'req.preferred_date as date',
                DB::raw('"Request" as type'),
                'req.waste_type',
                'req.quantity'
            );

        // Combine scheduled collections and assigned requests
        $todaysSchedule = $scheduledCollections
            ->union($assignedRequests)
            ->orderByRaw("FIELD(status, 'In Progress', 'Assigned')")
            ->get();

        // RECENT ACTIVITY - Last 3 completed collections/requests
        $recentActivity = DB::table('record_tbl as r')
            ->join('collectorsched_tbl as cs', 'r.sched_id', '=', 'cs.sched_id')
            ->join('area_tbl as a', 'r.brgy_id', '=', 'a.brgy_id')
            ->where('cs.collector_id', $collector->collector_id)
            ->where('r.status', 'Completed')
            ->select(
                'r.collection_date as date',
                'r.status',
                'a.brgy_name',
                'r.quantity_kg as quantity',
                DB::raw('"Scheduled Collection" as type')
            )
            ->unionAll(
                DB::table('request_tbl as req')
                    ->join('user_tbl as u', 'req.user_id', '=', 'u.user_id')
                    ->join('area_tbl as a', 'u.brgy_id', '=', 'a.brgy_id')
                    ->where('req.collector_id', $collector->collector_id)
                    ->where('req.status', 'Completed')
                    ->select(
                        'req.completion_date as date',
                        'req.status',
                        'a.brgy_name',
                        'req.quantity',
                        DB::raw('CONCAT("Request - ", req.waste_type) as type')
                    )
            )
            ->orderBy('date', 'desc')
            ->limit(3)
            ->get();

        // PENDING REQUESTS
        $pendingRequests = DB::table('request_tbl as req')
            ->join('user_tbl as u', 'req.user_id', '=', 'u.user_id')
            ->join('area_tbl as a', 'u.brgy_id', '=', 'a.brgy_id')
            ->whereNull('req.collector_id')
            ->where('req.status', 'Pending')
            ->select(
                'req.request_id',
                'req.quantity',
                'req.waste_type',
                'req.request_date',
                'req.preferred_date',
                'req.preferred_time',
                'a.brgy_name',
                DB::raw("CONCAT(u.firstname, ' ', u.lastname) as resident_name")
            )
            ->orderBy('req.preferred_date', 'asc')
            ->limit(3)
            ->get();

        // ASSIGNED TRUCK & AREAS
        $assignedTruck = DB::table('collectorsched_tbl as cs')
            ->join('truck_tbl as t', 'cs.license_plate', '=', 't.license_plate')
            ->where('cs.collector_id', $collector->collector_id)
            ->where('cs.collection_day', $today)
            ->select('t.license_plate', 't.capacity')
            ->first();

        $assignedAreas = DB::table('brgysched_tbl as bs')
            ->join('collectorsched_tbl as cs', 'bs.sched_id', '=', 'cs.sched_id')
            ->join('area_tbl as a', 'bs.brgy_id', '=', 'a.brgy_id')
            ->where('cs.collector_id', $collector->collector_id)
            ->where('cs.collection_day', $today)
            ->pluck('a.brgy_name')
            ->toArray();

        $allTrucks = DB::table('truck_tbl')
            ->select('license_plate', 'capacity')
            ->get();

        $availableTrucksPerRequest = [];
        foreach ($pendingRequests as $request) {
            $preferredDate = $request->preferred_date;
            $preferredDay = Carbon::parse($preferredDate)->format('l');

            $availableTrucks = DB::table('truck_tbl as t')
                ->whereNotExists(function ($query) use ($preferredDay) {
                    $query->select(DB::raw(1))
                        ->from('collectorsched_tbl as cs')
                        ->whereColumn('cs.license_plate', '=', 't.license_plate')
                        ->where('cs.collection_day', $preferredDay);
                })
                ->whereNotExists(function ($query) use ($preferredDate) {
                    $query->select(DB::raw(1))
                        ->from('request_tbl as req')
                        ->whereColumn('req.license_plate', '=', 't.license_plate')
                        ->whereDate('req.preferred_date', $preferredDate)
                        ->whereIn('req.status', ['Assigned', 'In Progress']);
                })
                ->select('t.license_plate', 't.capacity')
                ->get();

            $availableTrucksPerRequest[$request->request_id] = $availableTrucks;
        }

        return view('collector.dashboard', compact(
            'collector',
            'todaysSchedule',
            'recentActivity',
            'pendingRequests',
            'assignedTruck',
            'assignedAreas',
            'allTrucks',
            'availableTrucksPerRequest'
        ));
    }

    public function accept(Request $request, $requestId)
    {
        $collector = Auth::guard('collector')->user();

        $validated = $request->validate([
            'license_plate' => 'required|exists:truck_tbl,license_plate'
        ]);

        $requestData = DB::table('request_tbl as req')
            ->join('user_tbl as u', 'req.user_id', '=', 'u.user_id')
            ->join('area_tbl as a', 'u.brgy_id', '=', 'a.brgy_id')
            ->where('req.request_id', $requestId)
            ->where('req.status', 'Pending')
            ->where(function ($query) use ($collector) {
                $query->whereNull('req.collector_id')
                    ->orWhere('req.collector_id', $collector->collector_id);
            })
            ->select(
                'req.request_id',
                'req.quantity',
                'req.waste_type',
                'req.preferred_date',
                'req.preferred_time',
                DB::raw("CONCAT_WS(' ', u.firstname, COALESCE(u.middlename, ''), u.lastname) as resident_name"),
                'a.brgy_name',
                'u.street_address'
            )
            ->first();

        if (!$requestData) {
            return redirect()->route('collector.dashboard')
                ->with('error', 'Request not found or already taken');
        }

        $preferredDate = $requestData->preferred_date;
        $preferredDay = Carbon::parse($preferredDate)->format('l');

        $truckAvailable = DB::table('truck_tbl as t')
            ->where('t.license_plate', $validated['license_plate'])
            ->whereNotExists(function ($query) use ($preferredDay) {
                $query->select(DB::raw(1))
                    ->from('collectorsched_tbl as cs')
                    ->whereColumn('cs.license_plate', '=', 't.license_plate')
                    ->where('cs.collection_day', $preferredDay);
            })
            ->whereNotExists(function ($query) use ($preferredDate) {
                $query->select(DB::raw(1))
                    ->from('request_tbl as req')
                    ->whereColumn('req.license_plate', '=', 't.license_plate')
                    ->whereDate('req.preferred_date', $preferredDate)
                    ->whereIn('req.status', ['Assigned', 'In Progress']);
            })
            ->exists();

        if (!$truckAvailable) {
            return back()->with('error', 'Selected truck is not available');
        }

        // Update the request with collector and truck info
        $updated = DB::table('request_tbl')
            ->where('request_id', $requestId)
            ->update([
                'collector_id' => $collector->collector_id,
                'license_plate' => $validated['license_plate'],
                'status' => 'Assigned'
            ]);

        if ($updated) {
            return redirect()->route('collector.dashboard')
                ->with('show_success_modal', true);
        }

        return redirect()->route('collector.dashboard')
            ->with('error', 'Failed to accept request. Please try again.');
    }
}
