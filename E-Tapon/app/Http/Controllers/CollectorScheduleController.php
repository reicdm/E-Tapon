<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CollectorScheduleController extends Controller
{
    public function showSchedule()
    {
        $collector = Auth::guard('collector')->user();

        // Get all scheduled collections for this collector
        $scheduledCollections = DB::table('record_tbl as r')
            ->join('collectorsched_tbl as cs', 'r.sched_id', '=', 'cs.sched_id')
            ->join('area_tbl as a', 'r.brgy_id', '=', 'a.brgy_id')
            ->join('truck_tbl as t', 'cs.license_plate', '=', 't.license_plate')
            ->where('cs.collector_id', $collector->collector_id)
            ->select(
                'r.collection_date',
                'r.status',
                'r.quantity_kg',
                'a.brgy_name',
                'cs.license_plate',
                'cs.collection_day',
                'r.sched_id',
                'r.brgy_id',
                DB::raw("'scheduled' as source_type")
            )
            ->get();

        // Get all assigned requests for this collector
        $assignedRequests = DB::table('request_tbl as req')
            ->join('user_tbl as u', 'req.user_id', '=', 'u.user_id')
            ->join('area_tbl as a', 'u.brgy_id', '=', 'a.brgy_id')
            ->where('req.collector_id', $collector->collector_id)
            ->whereIn('req.status', ['Assigned', 'In Progress', 'Completed', 'Cancelled'])
            ->select(
                'req.preferred_date as collection_date',
                'req.status',
                'req.quantity',
                'a.brgy_name',
                'req.license_plate',
                'req.waste_type',
                'req.request_id',
                DB::raw("NULL as collection_day"),
                DB::raw("NULL as sched_id"),
                DB::raw("NULL as brgy_id"),
                DB::raw("'request' as source_type")
            )
            ->get();

        // Combine and organize by date
        $scheduleByDate = [];

        // Process scheduled collections
        foreach ($scheduledCollections as $collection) {
            $date = Carbon::parse($collection->collection_date)->format('Y-m-d');

            if (!isset($scheduleByDate[$date])) {
                $scheduleByDate[$date] = [
                    'date' => $collection->collection_date,
                    'day_name' => Carbon::parse($collection->collection_date)->format('D'),
                    'day_number' => Carbon::parse($collection->collection_date)->format('d'),
                    'items' => []
                ];
            }

            $scheduleByDate[$date]['items'][] = [
                'type' => 'scheduled',
                'brgy_name' => $collection->brgy_name,
                'license_plate' => $collection->license_plate,
                'status' => $collection->status,
                'quantity' => $collection->quantity_kg,
                'sched_id' => $collection->sched_id,
                'brgy_id' => $collection->brgy_id
            ];
        }

        // Process assigned requests
        foreach ($assignedRequests as $request) {
            $date = Carbon::parse($request->collection_date)->format('Y-m-d');

            if (!isset($scheduleByDate[$date])) {
                $scheduleByDate[$date] = [
                    'date' => $request->collection_date,
                    'day_name' => Carbon::parse($request->collection_date)->format('D'),
                    'day_number' => Carbon::parse($request->collection_date)->format('d'),
                    'items' => []
                ];
            }

            $scheduleByDate[$date]['items'][] = [
                'type' => 'request',
                'brgy_name' => $request->brgy_name,
                'license_plate' => $request->license_plate,
                'status' => $request->status,
                'quantity' => $request->quantity,
                'waste_type' => $request->waste_type,
                'request_id' => $request->request_id
            ];
        }

        // Sort by date
        ksort($scheduleByDate);

        // Get calendar events for FullCalendar
        $calendarEvents = [];
        foreach ($scheduleByDate as $dateData) {
            $eventCount = count($dateData['items']);
            $calendarEvents[] = [
                'title' => $eventCount . ' task' . ($eventCount > 1 ? 's' : ''),
                'start' => $dateData['date'],
                'backgroundColor' => '#FF8C42',
                'borderColor' => '#FF8C42'
            ];
        }

        return view('collector.schedule', compact('scheduleByDate', 'calendarEvents'));
    }

    // Show confirmation before updating status
    public function showUpdateConfirm(Request $request)
    {
        $collector = Auth::guard('collector')->user();

        $type = $request->query('type');
        $status = $request->query('status');
        $schedId = $request->query('sched_id');
        $brgyId = $request->query('brgy_id');
        $requestId = $request->query('request_id');

        // Verify ownership
        if ($type === 'scheduled') {
            $exists = DB::table('record_tbl as r')
                ->join('collectorsched_tbl as cs', 'r.sched_id', '=', 'cs.sched_id')
                ->where('r.sched_id', $schedId)
                ->where('r.brgy_id', $brgyId)
                ->where('cs.collector_id', $collector->collector_id)
                ->whereIn('r.status', ['Assigned', 'In Progress'])
                ->exists();
        } else {
            $exists = DB::table('request_tbl')
                ->where('request_id', $requestId)
                ->where('collector_id', $collector->collector_id)
                ->whereIn('status', ['Assigned', 'In Progress'])
                ->exists();
        }

        if (!$exists) {
            return redirect()->route('collector.schedule')
                ->with('error', 'Record not found or unauthorized');
        }

        return view('collector.confirm', [
            'confirmMessage' => 'Are you sure you want to update the status?',
            'confirmRoute' => route('collector.schedule.updateStatus'),
            'cancelRoute' => route('collector.schedule'),
            'hiddenInputs' => [
                'type' => $type,
                'status' => $status,
                'sched_id' => $schedId,
                'brgy_id' => $brgyId,
                'request_id' => $requestId
            ]
        ]);
    }

    public function updateStatus(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:scheduled,request',
            'status' => 'required|in:Assigned,Cancelled,In Progress,Completed',
            'sched_id' => 'required_if:type,scheduled',
            'brgy_id' => 'required_if:type,scheduled',
            'request_id' => 'required_if:type,request'
        ]);

        $collector = Auth::guard('collector')->user();

        try {
            if ($validated['type'] === 'scheduled') {
                // Verify ownership
                $exists = DB::table('record_tbl as r')
                    ->join('collectorsched_tbl as cs', 'r.sched_id', '=', 'cs.sched_id')
                    ->where('r.sched_id', $validated['sched_id'])
                    ->where('r.brgy_id', $validated['brgy_id'])
                    ->where('cs.collector_id', $collector->collector_id)
                    ->exists();

                if (!$exists) {
                    return redirect()->route('collector.schedule')
                        ->with('error', 'Record not found or unauthorized');
                }

                // Update record_tbl for scheduled collections
                $affected = DB::table('record_tbl')
                    ->where('sched_id', $validated['sched_id'])
                    ->where('brgy_id', $validated['brgy_id'])
                    ->update([
                        'status' => $validated['status']
                    ]);

                if ($affected === 0) {
                    return redirect()->route('collector.schedule')
                        ->with('error', 'Failed to update status');
                }
            } else {
                // Verify ownership
                $exists = DB::table('request_tbl')
                    ->where('request_id', $validated['request_id'])
                    ->where('collector_id', $collector->collector_id)
                    ->exists();

                if (!$exists) {
                    return redirect()->route('collector.schedule')
                        ->with('error', 'Request not found or unauthorized');
                }

                // Update request_tbl for requests
                $updateData = ['status' => $validated['status']];

                // If status is Completed, set completion_date
                if ($validated['status'] === 'Completed') {
                    $updateData['completion_date'] = now();
                }

                $affected = DB::table('request_tbl')
                    ->where('request_id', $validated['request_id'])
                    ->update($updateData);

                if ($affected === 0) {
                    return redirect()->route('collector.schedule')
                        ->with('error', 'Failed to update status');
                }
            }

            return view('collector.success', [
                'message' => 'Status Updated!'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('collector.schedule')
                ->with('error', 'Failed to update status: ' . $e->getMessage());
        }
    }
}
