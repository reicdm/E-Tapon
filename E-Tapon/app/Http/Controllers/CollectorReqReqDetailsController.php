<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CollectorReqReqDetailsController extends Controller
{
    // BLADE 1: Show request details page
    public function showRequestDetails($requestId)
    {
        $collector = Auth::guard('collector')->user();

        $requestData = DB::table('request_tbl as req')
            ->join('user_tbl as u', 'req.user_id', '=', 'u.user_id')
            ->join('area_tbl as a', 'u.brgy_id', '=', 'a.brgy_id')
            ->where('req.request_id', $requestId)
            ->where(function ($query) use ($collector) {
                $query->whereNull('req.collector_id')  // pending - anyone can see
                    ->orWhere('req.collector_id', $collector->collector_id); // accepted alr
            })
            ->whereIn('req.status', ['Pending', 'Assigned', 'In Progress'])
            ->select(
                'req.request_id',
                'req.quantity',
                'req.waste_type',
                'req.preferred_date',
                'req.preferred_time',
                'req.status',
                'req.license_plate',
                'req.collector_id',
                DB::raw("CONCAT_WS(' ', u.firstname, COALESCE(u.middlename, ''), u.lastname) as resident_name"),
                'a.brgy_name',
                'u.street_address'
            )
            ->first();

        if (!$requestData) {
            return redirect()->route('collector.request')
                ->with('error', 'Request not found or already taken');
        }

        $preferredDate = $requestData->preferred_date;
        $preferredDay = Carbon::parse($preferredDate)->format('l');

        $availableTrucks = collect([]);
        if ($requestData->status === 'Pending') {
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
        }

        return view('collector.reqdetails', [
            'requestData' => $requestData,
            'availableTrucks' => $availableTrucks
        ]);
    }

    // Show confirmation before accepting request
    public function showAcceptConfirm(Request $request, $requestId)
    {
        $collector = Auth::guard('collector')->user();

        $license_plate = $request->query('license_plate');

        // Verify request is still available
        $requestData = DB::table('request_tbl')
            ->where('request_id', $requestId)
            ->where('status', 'Pending')
            ->where(function ($query) use ($collector) {
                $query->whereNull('collector_id')
                    ->orWhere('collector_id', $collector->collector_id);
            })
            ->first();

        if (!$requestData) {
            return redirect()->route('collector.request')
                ->with('error', 'Request not found or already taken');
        }

        return view('collector.confirm', [
            'confirmMessage' => 'Are you sure you want to accept this request?',
            'confirmRoute' => route('collector.reqdetails.accept', $requestId),
            'cancelRoute' => route('collector.reqdetails.showRequestDetails', $requestId),
            'hiddenInputs' => [
                'license_plate' => $license_plate
            ],
            'requestId' => $requestId
        ]);
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
            return redirect()->route('collector.request')
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
            return view('collector.success', [
                'message' => 'Request Accepted!',
                'requestId' => $requestId
            ]);
        }

        return redirect()->route('collector.request')
            ->with('error', 'Failed to accept request. Please try again.');
    }

    public function decline($requestId)
    {
        return redirect()->route('collector.request')
            ->with('info', 'Request skipped');
    }
}
