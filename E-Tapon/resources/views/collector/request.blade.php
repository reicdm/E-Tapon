@extends('layouts.collector_request')
@section('title', 'Collector Request')
@section('content')

<div id="requesttab" class="min-h-screen flex flex-col p-2">

    <!-- TOP CONTAINER -->
    <div class="mx-auto max-w-4xl w-full p-2">
        <div class="row-top row-top justify-content-center">
            <h1 class="font-extrabold" style="color: var(--color-dark-green) ">Request to Approve</h1>
        </div>

        <!-- REQUEST TO APPROVE -->
        <div id="topCarousel" class="carousel slide" data-bs-wrap="false">
            <div class="carousel-inner mb-3">
                @forelse($pendingRequests->chunk(2) as $index => $chunk)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <div class="row g-3">
                        @foreach($chunk as $request)
                        <!-- CARDS -->
                        <div class="col-6 col-md-6">
                            <div class="card card-top h-100">
                                <div class="card-top-details">
                                    <div class="card-top-circle-date">
                                        <div class="circle-top">
                                            <img src="{{ asset('icons/O_' . strtolower(str_replace('-', '', $request->waste_type === 'Recyclable' ? 'recycle' : ($request->waste_type === 'Biodegradable' ? 'bio' : 'nonbio'))) . '.png') }}" class="wastes-img-top">
                                        </div>
                                        <h2 class="card-top-text-date">{{ $request->formatted_date }}</h2>
                                    </div>
                                    <div class="card-top-data">
                                        <h5 class="card-top-title">{{ $request->user_name }}</h5>
                                        <p class="card-top-text"><b>Waste Type:</b> {{ $request->waste_type }}</p>
                                        <p class="card-top-text"><b>Qty:</b> {{ $request->quantity }}kg</p>
                                    </div>
                                </div>
                                <button type="button"
                                    class="card-top-button"
                                    onclick="openRequestModal(this)"
                                    data-request-id="{{ $request->request_id }}"
                                    data-reqname="{{ $request->resident_name }}"
                                    data-reqbrgy="{{ $request->brgy_name }}"
                                    data-reqwaste="{{ $request->waste_type }}"
                                    data-reqquantity="{{ number_format($request->quantity, 2) }}kg"
                                    data-reqdate="{{ \Carbon\Carbon::parse($request->preferred_date)->format('F d, Y') }}"
                                    data-reqtime="{{ $request->preferred_time }}">
                                    View Details
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @empty
                <div class="carousel-item active">
                    <div class="row g-3">
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">No pending requests</p>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>

            @if($pendingRequests->count() > 2)
            <button class="top-carousel-control-prev" type="button" data-bs-target="#topCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="top-carousel-control-next" type="button" data-bs-target="#topCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            @endif

            <div class="carousel-indicators">
                @foreach($pendingRequests->chunk(2) as $index => $chunk)
                <button type="button"
                    data-bs-target="#topCarousel"
                    data-bs-slide-to="{{ $index }}"
                    class="{{ $index === 0 ? 'active' : '' }}"
                    aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                    aria-label="Slide {{ $index + 1 }}">
                </button>
                @endforeach
            </div>
        </div>

        <!-- MID CONTAINER -->
        <div class="mx-auto max-w-4xl w-full px-2">
            <div class="row-mid justify-content-center">
                <h2 class="font-extrabold" style="color: var(--color-dark-green) ">Accepted Request</h2>
            </div>
            <div id="midCarousel" class="carousel slide" data-bs-wrap="false">
                <div class="carousel-inner mb-2">
                    @forelse($acceptedRequests->chunk(2) as $index => $chunk)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="row g-3">
                            @foreach($chunk as $request)
                            <div class="col-6 col-md-6">
                                <div class="card card-mid h-100">
                                    <div class="card-mid-details">
                                        <div class="card-mid-circle-date">
                                            <div class="circle-mid">
                                                <img src="{{ asset('icons/DG_' . strtolower(str_replace('-', '', $request->waste_type === 'Recyclable' ? 'recycle' : ($request->waste_type === 'Biodegradable' ? 'bio' : 'nonbio'))) . '.png') }}" class="wastes-img-mid">
                                            </div>
                                            <h2 class="card-mid-text-date">{{ $request->formatted_date }}</h2>
                                        </div>
                                        <div class="card-mid-data">
                                            <h5 class="card-mid-title">{{ $request->user_name }}</h5>
                                            <p class="card-mid-text"><b>Waste Type:</b> {{ $request->waste_type }}</p>
                                            <p class="card-mid-text"><b>Qty:</b> {{ $request->quantity }}kg</p>
                                        </div>
                                    </div>
                                    <button type="button"
                                        class="card-mid-button"
                                        onclick="openAcceptedModal(this)"
                                        data-request-id="{{ $request->request_id }}"
                                        data-accname="{{ $request->resident_name }}"
                                        data-accbrgy="{{ $request->brgy_name }}"
                                        data-accwaste="{{ $request->waste_type }}"
                                        data-accquantity="{{ number_format($request->quantity, 2) }}kg"
                                        data-accdate="{{ \Carbon\Carbon::parse($request->preferred_date)->format('F d, Y') }}"
                                        data-acctime="{{ $request->preferred_time }}"
                                        data-acctruck="{{ $request->license_plate }}"
                                        data-current-status="{{ $request->status }}">
                                        View Details
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @empty
                    <div class="carousel-item active">
                        <div class="row g-3">
                            <div class="col-12 text-center py-5">
                                <p class="text-muted">No accepted requests at the moment</p>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
                @if($acceptedRequests->count() > 2)
                <button class="mid-carousel-control-prev" type="button" data-bs-target="#midCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="mid-carousel-control-next" type="button" data-bs-target="#midCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                @endif

                <div class="carousel-indicators">
                    @foreach($acceptedRequests->chunk(2) as $index => $chunk)
                    <button type="button"
                        data-bs-target="#midCarousel"
                        data-bs-slide-to="{{ $index }}"
                        class="{{ $index === 0 ? 'active' : '' }}"
                        aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                        aria-label="Slide {{ $index + 1 }}">
                    </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- BOTTOM CONTAINER -->
        <div class="row row-con justify-content-center g-2">
            <div class="col">
                <div class="card-bot">
                    <div class="card-header-with-link">
                        <h2 class="font-extrabold" style="color: var(--color-light-olive) ">Completed Request</h2>
                    </div>
                    <div class="card-req">
                        <div class="col">
                            @forelse($completedRequests as $request)
                            <div class="card-data-box-req">
                                <div class="circle">
                                    <img src="{{ asset('icons/C_' . strtolower(str_replace('-', '', $request->waste_type === 'Recyclable' ? 'recycle' : ($request->waste_type === 'Biodegradable' ? 'bio' : 'nonbio'))) . '.png') }}" class="waste-img-bot">
                                </div>
                                <div class="card-req-info">
                                    <h2 class="card-req-text-name">{{ $request->user_name }}</h2>
                                    <p class="card-req-text-wk">{{ $request->waste_type }}, {{ $request->quantity }}kg</p>
                                </div>
                                <div class="card-req-right">
                                    <p class="card-req-text-date">{{ $request->formatted_date }}</p>
                                    <button type="button" class="btn-completed">Completed</button>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-4">
                                <p class="text-muted">No completed requests yet</p>
                            </div>
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
<script type="application/json" id="trucks-data">
    @json($availableTrucksPerRequest)
</script>

<script>
    const availableTrucksData = JSON.parse(document.getElementById('trucks-data').textContent);

    function openRequestModal(button) {
        document.getElementById('reqname').value = button.dataset.reqname || '';
        document.getElementById('reqbrgy').value = button.dataset.reqbrgy || '';
        document.getElementById('reqwaste').value = button.dataset.reqwaste || '';
        document.getElementById('reqquantity').value = button.dataset.reqquantity || '';
        document.getElementById('reqdate').value = button.dataset.reqdate || '';
        document.getElementById('reqtime').value = button.dataset.reqtime || '';

        const modal = document.getElementById('requestModal');
        const requestId = button.dataset.requestId;
        modal.dataset.requestId = requestId;

        const form = document.getElementById('acceptRequestForm');
        form.action = `/collector/request/${requestId}/accept`;

        const truckSelect = document.getElementById('reqtruck');
        truckSelect.innerHTML = '<option value="">-- Select Truck --</option>';

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

        modal.style.display = 'flex';
    }

    function showConfirmation() {
        if (!document.getElementById('reqtruck').value) {
            alert('Please select a truck before accepting the request.');
            return;
        }
        document.getElementById('requestModal').style.display = 'none';
        document.getElementById('confirmModal').style.display = 'flex';
    }

    function confirmUpdRequest() {
        document.getElementById('acceptRequestForm').submit();
    }

    function closeSuccessUpdModal() {
        document.getElementById('confirmSuccessModal').style.display = 'none';
        window.location.reload();
    }

    function closeRequestModal() {
        document.getElementById('requestModal').style.display = 'none';
    }

    function closeConfirmModal() {
        document.getElementById('confirmModal').style.display = 'none';
        document.getElementById('requestModal').style.display = 'flex';
    }

    window.onclick = function(event) {
        const requestModal = document.getElementById('requestModal');
        const confirmModal = document.getElementById('confirmModal');
        const successModal = document.getElementById('confirmSuccessModal');

        if (event.target == requestModal) closeRequestModal();
        if (event.target == confirmModal) closeConfirmModal();
        if (event.target == successModal) closeSuccessUpdModal();
    }
</script>

@if(session('show_success_modal'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('confirmSuccessModal').style.display = 'flex';
    });
</script>
@endif
@endpush