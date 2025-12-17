<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CollectorAcceptedReqController extends Controller
{
    public function showAcceptedRequest($requestId)
    {
        $collector = Auth::guard('collector')->user();

        $requestData = DB::table('request_tbl as req')
            ->join('user_tbl as u', 'req.user_id', '=', 'u.user_id')
            ->join('area_tbl as a', 'u.brgy_id', '=', 'a.brgy_id')
            ->where('req.request_id', $requestId)
            ->where('req.collector_id', $collector->collector_id)
            ->whereIn('req.status', ['Assigned', 'In Progress'])
            ->select(
                'req.request_id',
                'req.quantity',
                'req.waste_type',
                'req.preferred_date',
                'req.preferred_time',
                'req.status',
                'req.license_plate',
                DB::raw("CONCAT_WS(' ', u.firstname, COALESCE(u.middlename, ''), u.lastname) as resident_name"),
                'a.brgy_name',
                'u.street_address'
            )
            ->first();

        if (!$requestData) {
            return redirect()->route('collector.dashboard')
                ->with('error', 'Request not found or unauthorized');
        }

        return view('collector.acceptedreq', [
            'requestData' => $requestData
        ]);
    }

    public function updateStatus(Request $request, $requestId)
    {
        $collector = Auth::guard('collector')->user();

        $validated = $request->validate([
            'status' => 'required|in:Assigned,In Progress,Completed,Cancelled'
        ]);

        $requestData = DB::table('request_tbl')
            ->where('request_id', $requestId)
            ->where('collector_id', $collector->collector_id)
            ->whereIn('status', ['Assigned', 'In Progress'])
            ->first();

        if (!$requestData) {
            return redirect()->route('collector.dashboard')
                ->with('error', 'Request not found or unauthorized');
        }

        $updateData = [
            'status' => $validated['status']
        ];

        if ($validated['status'] === 'Completed') {
            $updateData['completion_date'] = now();
        }

        DB::table('request_tbl')
            ->where('request_id', $requestId)
            ->where('collector_id', $collector->collector_id)
            ->update($updateData);

        return redirect()->route('collector.dashboard')
            ->with('success', 'Request status updated successfully');
    }
}
