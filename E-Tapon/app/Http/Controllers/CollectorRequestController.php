<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class CollectorRequestController extends Controller
{
    public function showRequest()
    {
        $collector = Auth::guard('collector')->user();

        // TOP: Request to Approve - All PENDING requests from collector's assigned barangays
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
                DB::raw("CONCAT(u.firstname, ' ', u.lastname) as user_name"),
                DB::raw("CONCAT(u.firstname, ' ', u.lastname) as resident_name"),
                DB::raw("DATE_FORMAT(req.preferred_date, '%b %d') as formatted_date")
            )
            ->orderBy('req.preferred_date', 'asc')
            ->get();

        // MIDDLE: ACCEPTED requests (Assigned or In Progress)
        $acceptedRequests = DB::table('request_tbl as req')
            ->join('user_tbl as u', 'req.user_id', '=', 'u.user_id')
            ->join('area_tbl as a', 'u.brgy_id', '=', 'a.brgy_id')
            ->where('req.collector_id', $collector->collector_id)
            ->whereIn('req.status', ['Assigned', 'In Progress'])
            ->select(
                'req.request_id',
                'req.quantity',
                'req.waste_type',
                'req.preferred_date',
                'req.preferred_time',
                'req.license_plate',
                'req.status',
                'a.brgy_name',
                DB::raw("CONCAT(u.firstname, ' ', u.lastname) as user_name"),
                DB::raw("CONCAT(u.firstname, ' ', u.lastname) as resident_name"),
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
            ->limit(3)
            ->get();

        // Build a map of available trucks per request (for pending requests)
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

        return view('collector.request', compact(
            'pendingRequests',
            'acceptedRequests',
            'completedRequests',
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

        DB::statement('CALL sp_accept_request(?, ?, ?)', [
            $requestId,
            $collector->collector_id,
            $validated['license_plate']
        ]);

        return redirect()->route('collector.dashboard')
            ->with('show_success_modal', true);

        return redirect()->route('collector.dashboard')
            ->with('error', 'Failed to accept request. Please try again.');
    }

    public function updateStatus(Request $request, $requestId)
    {
        $collector = Auth::guard('collector')->user();

        $validated = $request->validate([
            'status' => 'required|in:Assigned,In Progress,Completed,Cancelled'
        ]);

        // Verify this request belongs to this collector and is in valid status
        $requestData = DB::table('request_tbl')
            ->where('request_id', $requestId)
            ->where('collector_id', $collector->collector_id)
            ->whereIn('status', ['Assigned', 'In Progress'])
            ->first();

        if (!$requestData) {
            return redirect()->route('collector.request')
                ->with('error', 'Request not found or unauthorized');
        }

        // Prepare update data
        $updateData = [
            'status' => $validated['status']
        ];

        // Add completion date if status is Completed
        if ($validated['status'] === 'Completed') {
            $updateData['completion_date'] = now();
        }

        // Update the status
        $updated = DB::table('request_tbl')
            ->where('request_id', $requestId)
            ->where('collector_id', $collector->collector_id)
            ->update($updateData);

        if ($updated) {
            return redirect()->route('collector.request')
                ->with('show_update_success_modal', true);
        }

        return redirect()->route('collector.request')
            ->with('error', 'Failed to update status. Please try again.');
    }
}
