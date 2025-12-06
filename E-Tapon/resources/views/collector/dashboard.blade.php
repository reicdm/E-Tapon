@extends('layouts.collector_dashboard')

@section('title', 'Collector Dashboard')

@section('content')
<div class="min-h-screen flex flex-col p-2">
    <div class="mx-auto max-w-4xl w-full p-2">
        <div class="row row-wel justify-content-center">
            <h2 class="font-extrabold" style="color: var(--color-dark-green) ">Welcome, {{ $collector->firstname }}!</h2>
            <p style="color: var(--color-dark-green) ">ID: {{ $collector->collector_id }}</p>
        </div>

        <div class="row row-con row-cols-2 row-cols-md-2 justify-content-center g-2">
            <div class="col">
                <div class="card-top">
                    <div class="card-body">
                        <h6 class="card-top-title">Assigned Area</h6>
                        <div class="card-data-box-area">
                            @if(!empty($assignedAreas))
                            @foreach($assignedAreas as $area)
                            <p class="card-text">{{ $area }}</p>
                            @endforeach
                            @else
                            <p class="card-text">No assigned area for today</p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card-top">
                    <div class="card-body">
                        <h5 class="card-top-title">Assigned Truck</h5>
                        <div class="card-data-box-truck">
                            @if($assignedTruck)
                            <p class="card-text">Plate no.: {{ $assignedTruck->license_plate }}</p>
                            <p class="card-text">Capacity: {{ $assignedTruck->capacity }}</p>
                            @else
                            <p class="card-text">Plate no.: Not Assigned Today</p>
                            <p class="card-text">Capacity: N/A</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-con justify-content-center g-2">
            <div class="col">
                <div class="card-mid">
                    <div class="card-header-with-link">
                        <h2 class="font-extrabold" style="color: var(--color-dark-green) ">Collection Schedule</h2>
                        <a href="{{ route('collector.schedule') }}" class="view-all-link">
                            View all →
                        </a>
                    </div>
                    <div class="row-sched row-cols-3">
                        @forelse($recentSchedules as $schedule)
                        <a href="{{ route('collector.schedule') }}" class="card-link">
                            <div class="col">
                                <div class="card-status-bg-{{ strtolower(str_replace(' ', '', $schedule->status)) }}">
                                    <h2 class="card-sched-text-date">
                                        {{ strtoupper(\Carbon\Carbon::parse($schedule->date)->format('M d')) }}
                                    </h2>
                                    <div>
                                        <p class="card-sched-text-ba">{{ $schedule->brgy_name }}</p>
                                        <p class="card-sched-text-ba">{{ $schedule->license_plate }}</p>
                                    </div>
                                    <div class="card-sched-status">
                                        <p class="sched-status-{{ strtolower(str_replace(' ', '', $schedule->status)) }}">
                                            {{ $schedule->status }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="col">
                            <p class="text-muted">No schedules available</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-con justify-content-center g-2">
            <div class="col">
                <div class="card-bot">
                    <div class="card-header-with-link">
                        <h2 class="font-extrabold" style="color: var(--color-light-olive) ">Request to Approve</h2>
                        <a href="{{ route('collector.request') }}" class="view-all-link">
                            View all →
                        </a>
                    </div>
                    <div class="card-req">
                        <div class="col">
                            @forelse($pendingRequests as $request)
                            <div class="card-data-box-req">
                                <div class="circle">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/7b/Recycling_symbol.svg" class="wastes-img">
                                </div>
                                <div class="card-req-info">
                                    <h2 class="card-req-text-name">{{ $request->resident_name }}</h2>
                                    <p class="card-req-text-wk">{{ $request->waste_type }}</p>
                                    <p class="card-req-text-wk">{{ number_format($request->quantity, 2) }}kg</p>
                                </div>
                                <div class="card-req-right">
                                    <p class="card-req-text-date">
                                        {{ \Carbon\Carbon::parse($request->request_date)->format('m/d/y') }}
                                    </p>
                                    <button class="btn-details"><a href="{{ route('collector.requestdetails', $request->request_id) }}">
                                            Details
                                        </a></button>
                                </div>
                            </div>
                            @empty
                            <p class="text-muted">No pending requests</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection