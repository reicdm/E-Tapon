<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CollectorDashboardController extends Controller
{
    // LOGIN
    public function showOverview()
    {
        $collector = Auth::guard('collector')->user();

        $recentSchedules = DB::table('record_tbl as r')
            ->join('collectorsched_tbl as cs', 'r.sched_id', '=', 'cs.sched_id')
            ->join('area_tbl as a', 'r.brgy_id', '=', 'a.brgy_id')
            ->join('truck_tbl as t', 'cs.license_plate', '=', 't.license_plate')
            ->where('cs.collector_id', $collector->collector_id)
            ->select(
                'r.collection_date',
                'r.status',
                'a.brgy_name',
                'cs.license_plate',
                'cs.collection_day'
            )
            ->orderBy('r.collection_date', 'desc')
            ->limit(3)
            ->get();

        $pendingRequests = DB::table('request_tbl as req')
            ->join('user_tbl as u', 'req.user_id', '=', 'u.user_id')
            ->where('req.collector_id', $collector->collector_id)
            ->where('req.status', 'Pending')
            ->select(
                'req.request_id',
                'req.quantity',
                'req.waste_type',
                'req.request_date',
                DB::raw("CONCAT(u.firstname, ' ', u.lastname) as resident_name")
            )
            ->orderBy('req.request_date', 'desc')
            ->limit(3)
            ->get();


        $today = now()->format('l');

        $today = now()->format('l');

        $assignedTruck = DB::table('collectorsched_tbl as cs')
            ->join('truck_tbl as t', 'cs.license_plate', '=', 't.license_plate')
            ->where('cs.collector_id', $collector->collector_id)
            ->where('cs.collection_day', $today)
            ->select(
                't.license_plate',
                't.capacity'
            )
            ->first();


        $assignedAreas = DB::table('brgysched_tbl as bs')
            ->join('collectorsched_tbl as cs', 'bs.sched_id', '=', 'cs.sched_id')
            ->join('area_tbl as a', 'bs.brgy_id', '=', 'a.brgy_id')
            ->where('cs.collector_id', $collector->collector_id)
            ->where('cs.collection_day', $today)
            ->select('a.brgy_name')
            ->distinct()
            ->pluck('a.brgy_name')
            ->toArray();


        return view('collector.dashboard', compact(
            'collector',
            'recentSchedules',
            'pendingRequests',
            'assignedTruck',
            'assignedAreas'
        ));
    }
}
