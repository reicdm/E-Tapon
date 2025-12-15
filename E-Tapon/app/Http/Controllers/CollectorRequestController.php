<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CollectorRequestController extends Controller
{
    public function showRequest()
    {
        $collector = Auth::guard('collector')->user();

        // TOP: Request to Approve - All PENDING requests from collector's assigned barangays
        $pendingRequests = DB::table('request_tbl as req')
            ->join('user_tbl as u', 'req.user_id', '=', 'u.user_id')
            ->whereNull('req.collector_id')  // Unassigned
            ->where('req.status', 'Pending')
            ->select(
                'req.request_id',
                'req.quantity',
                'req.waste_type',
                'req.preferred_date',
                DB::raw("CONCAT(u.firstname, ' ', u.lastname) as user_name"),
                DB::raw("DATE_FORMAT(req.preferred_date, '%b %d') as formatted_date")
            )
            ->orderBy('req.preferred_date', 'asc')
            ->get();

        // MIDDLE: ACCEPTED requests (Assigned or In Progress)
        $acceptedRequests = DB::table('request_tbl as req')
            ->join('user_tbl as u', 'req.user_id', '=', 'u.user_id')
            ->where('req.collector_id', $collector->collector_id)
            ->whereIn('req.status', ['Assigned', 'In Progress'])
            ->select(
                'req.request_id',
                'req.quantity',
                'req.waste_type',
                'req.preferred_date',
                'req.status',
                DB::raw("CONCAT(u.firstname, ' ', u.lastname) as user_name"),
                DB::raw("DATE_FORMAT(req.preferred_date, '%b %d') as formatted_date")
            )
            ->orderBy('req.preferred_date', 'asc')
            ->get();

        // BOTTOM: Completed Request - All COMPLETED requests
        $completedRequests = DB::table('request_tbl as req')
            ->join('user_tbl as u', 'req.user_id', '=', 'u.user_id')
            ->where('req.collector_id', $collector->collector_id)
            ->where('req.status', 'Completed')
            ->select(
                'req.request_id',
                'req.quantity',
                'req.waste_type',
                'req.completion_date',
                DB::raw("CONCAT(u.firstname, ' ', u.lastname) as user_name"),
                DB::raw("DATE_FORMAT(req.completion_date, '%m/%d/%y') as formatted_date")
            )
            ->orderBy('req.completion_date', 'desc')
            ->limit(20)
            ->get();

        return view('collector.request', compact(
            'pendingRequests',
            'acceptedRequests',
            'completedRequests'
        ));
    }
}
