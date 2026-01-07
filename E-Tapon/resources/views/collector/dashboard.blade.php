@extends('layouts.collector_dashboard')

@section('title', 'Collector Dashboard')

@section('content')
<div id="dashboard" class="min-h-screen flex flex-col p-2">
    <div class="mx-auto max-w-4xl w-full p-2">
        <!-- GREETINGS -->
        <div class="row row-wel justify-content-center">
            <h2 class="font-extrabold" style="color: var(--color-dark-green) ">Welcome, {{ $collector->firstname }}!</h2>
            <p style="color: var(--color-dark-green) ">ID: {{ $collector->collector_id }}</p>
        </div>

        <!-- TOP CONTAINER -->
        <div class="row row-con row-cols-2 row-cols-md-2 justify-content-center g-2">
            <div class="col">
                <!-- ASSIGNED AREA -->
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
                <!-- ASSIGNED TRUCK -->
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

        <!-- MID CONTAINER -->
        <div class="row row-con justify-content-center g-2">
            <div class="col">
                <div class="card-mid">
                    <div class="card-header-with-link">
                        <h2 class="font-extrabold" style="color: var(--color-dark-green) ">Collection Schedule</h2>
                        <a href="{{ route('collector.schedule') }}" class="view-all-link">
                            View all →
                        </a>
                    </div>
                    <!-- CARDS -->
                    <div class="row-sched row-cols-3">
                        @forelse($todaysSchedule as $schedule)
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

        <!-- BOTTOM CONTAINER -->
        <div class="row row-con justify-content-center g-2">
            <div class="col">
                <div class="card-bot">
                    <div class="card-header-with-link">
                        <h2 class="font-extrabold" style="color: var(--color-light-olive) ">Request to Approve</h2>
                        <a href="{{ route('collector.request') }}" class="view-all-link">
                            View all →
                        </a>
                    </div>
                    <!-- CARDS -->
                    <div class="card-req">
                        <div class="col">
                            @forelse($pendingRequests as $request)
                            <div class="card-data-box-req">
                                <div class="circle">
                                    @php
                                    $wasteTypeMap = [
                                    'Recyclable' => 'recycle',
                                    'Biodegradable' => 'bio',
                                    'Non-Biodegradable' => 'nonbio',
                                    ];
                                    $iconName = $wasteTypeMap[$request->waste_type] ?? 'recycle';
                                    @endphp
                                    <img src="{{ asset('icons/C_' . $iconName . '.png') }}" class="waste-img" alt="{{ $request->waste_type }}">
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
                                    <button type="button"
                                        class="btn-details"
                                        onclick="openRequestModal(this)"
                                        data-request-id="{{ $request->request_id }}"
                                        data-reqname="{{ $request->resident_name }}"
                                        data-reqbrgy="{{ $request->brgy_name }}"
                                        data-reqwaste="{{ $request->waste_type }}"
                                        data-reqquantity="{{ number_format($request->quantity, 2) }}kg"
                                        data-reqdate="{{ \Carbon\Carbon::parse($request->preferred_date)->format('F d, Y') }}"
                                        data-reqtime="{{ $request->preferred_time }}">
                                        Details
                                    </button>
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

@push('scripts')
<!-- Hidden script tag to hold JSON data -->
<script type="application/json" id="trucks-data">
    @json($availableTrucksPerRequest)
</script>

<script>
    // Parse the available trucks data
    const availableTrucksData = JSON.parse(
        document.getElementById('trucks-data').textContent
    );

    function openRequestModal(button) {
        console.log('Opening modal...');
        console.log('Button data:', button.dataset);

        // Populate modal fields with data from button attributes
        document.getElementById('reqname').value = button.dataset.reqname || '';
        document.getElementById('reqbrgy').value = button.dataset.reqbrgy || '';
        document.getElementById('reqwaste').value = button.dataset.reqwaste || '';
        document.getElementById('reqquantity').value = button.dataset.reqquantity || '';
        document.getElementById('reqdate').value = button.dataset.reqdate || '';
        document.getElementById('reqtime').value = button.dataset.reqtime || '';

        // Store request ID in modal for later use
        const modal = document.getElementById('requestModal');
        const requestId = button.dataset.requestId;
        modal.dataset.requestId = requestId;

        // Update form action with the correct route
        const form = document.getElementById('acceptRequestForm');
        form.action = `/collector/dashboard/${requestId}/accept`;

        // Populate truck dropdown with available trucks for this request
        const truckSelect = document.getElementById('reqtruck');
        truckSelect.innerHTML = '<option value="">-- Select Truck --</option>';

        // Get available trucks for this specific request
        const availableTrucks = availableTrucksData[requestId] || [];

        if (availableTrucks.length > 0) {
            availableTrucks.forEach(truck => {
                const option = document.createElement('option');
                option.value = truck.license_plate;
                option.textContent = `${truck.license_plate} (${truck.capacity} capacity)`;
                truckSelect.appendChild(option);
            });
        } else {
            const option = document.createElement('option');
            option.value = '';
            option.textContent = 'No trucks available for this date';
            option.disabled = true;
            truckSelect.appendChild(option);
        }

        // Display the modal
        modal.style.display = 'flex';

        console.log('Modal displayed');
    }

    function showConfirmation() {
        const truckSelect = document.getElementById('reqtruck');

        // Check if a truck is selected
        if (!truckSelect.value) {
            alert('Please select a truck before accepting the request.');
            return; // Stop execution - don't show confirmation modal
        }

        // If truck is selected, show confirmation modal
        document.getElementById('requestModal').style.display = 'none';
        document.getElementById('confirmModal').style.display = 'flex';
    }

    function confirmUpdRequest() {
        // Submit the form - this will redirect back with session data
        document.getElementById('acceptRequestForm').submit();
    }

    function closeSuccessUpdModal() {
        document.getElementById('confirmSuccessModal').style.display = 'none';
        // Reload page to refresh the dashboard
        window.location.reload();
    }

    function closeRequestModal() {
        console.log('Closing modal...');
        const modal = document.getElementById('requestModal');
        modal.style.display = 'none';
    }

    function closeConfirmModal() {
        const modal = document.getElementById('confirmModal');
        if (modal) {
            modal.style.display = 'none';
        }
        // Show request modal again
        document.getElementById('requestModal').style.display = 'flex';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const requestModal = document.getElementById('requestModal');
        const confirmModal = document.getElementById('confirmModal');
        const successModal = document.getElementById('confirmSuccessModal');

        if (event.target == requestModal) {
            closeRequestModal();
        }
        if (event.target == confirmModal) {
            closeConfirmModal();
        }
        if (event.target == successModal) {
            closeSuccessUpdModal();
        }
    }
</script>

@if(session('show_success_modal'))
<script>
    // Show success modal when page loads
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('confirmSuccessModal').style.display = 'flex';
    });
</script>
@endif

@endpush