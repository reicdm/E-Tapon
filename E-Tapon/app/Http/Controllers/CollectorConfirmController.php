<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CollectorConfirmController extends Controller
{
    // Show confirmation page
    public function showConfirm(Request $request)
    {
        $collector = Auth::guard('collector')->user();

        $requestId = $request->query('requestId');
        $licensePlate = $request->query('license_plate');

        // Get request details for confirmation page
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

        return view('collector.confirm', [
            'requestData' => $requestData,
            'confirmMessage' => 'Are you sure you want to accept this request?',
            'confirmRoute' => route('collector.confirmAccept', $requestId),
            'cancelRoute' => route('collector.reqdetails.showRequestDetails', $requestId),
            'hiddenInputs' => [
                'license_plate' => $licensePlate
            ],
            'licensePlate' => $licensePlate,
            'requestId' => $requestId
        ]);
    }

    // Handle "Confirm" button - UPDATE DATABASE
    public function confirmAccept(Request $request, $requestId)
    {
        $collector = Auth::guard('collector')->user();

        $validated = $request->validate([
            'license_plate' => 'required|exists:truck_tbl,license_plate'
        ]);

        // Verify if request is still pending
        $requestData = DB::table('request_tbl')
            ->where('request_id', $requestId)
            ->where('status', 'Pending')
            ->where(function ($query) use ($collector) {
                $query->whereNull('collector_id')
                    ->orWhere('collector_id', $collector->collector_id);
            })
            ->first();

        if (!$requestData) {
            return redirect()->route('collector.dashboard')
                ->with('error', 'Request no longer available');
        }

        $preferredDate = $requestData->preferred_date;
        $preferredDay = Carbon::parse($preferredDate)->format('l');

        // Final truck availability check
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
            return redirect()->route('collector.dashboard')
                ->with('error', 'Selected truck is no longer available');
        }

        // DATABASE UPDATE
        $updated = DB::table('request_tbl')
            ->where('request_id', $requestId)
            ->where('status', 'Pending')
            ->where(function ($query) use ($collector) {
                $query->whereNull('collector_id')
                    ->orWhere('collector_id', $collector->collector_id);
            })
            ->update([
                'collector_id' => $collector->collector_id,
                'status' => 'Assigned',
                'license_plate' => $validated['license_plate']
            ]);

        if ($updated) {
            return redirect()->route('collector.success', ['requestId' => $requestId]);
        }

        // Fallback if update fails
        return redirect()->route('collector.dashboard')
            ->with('error', 'Failed to assign request. Please try again.');
    }
}
