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

            <!-- BUTTONS -->
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
            <!-- ACCEPTED REQUEST -->
            <div id="midCarousel" class="carousel slide" data-bs-wrap="false">
                <div class="carousel-inner mb-2">
                    @forelse($acceptedRequests->chunk(2) as $index => $chunk)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="row g-3">
                            @foreach($chunk as $request)
                            <!-- CARDS -->
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
                                        data-accname="John Doe"
                                        data-accbrgy="Brgy. 123"
                                        data-accwaste="Recyclable"
                                        data-accquantity="1kg"
                                        data-accdate="January 1, 2025"
                                        data-acctime="10:00 AM"
                                        data-acctruck="ABC 1234 (5-ton capacity)">
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
                <!-- BUTTONS -->
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
                <!-- COMPLETED REQUEST -->
                <div class="card-bot">
                    <div class="card-header-with-link">
                        <h2 class="font-extrabold" style="color: var(--color-light-olive) ">Completed Request</h2>
                    </div>

                    <!-- CARDS -->
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
                                    class="btn-details"
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

            <!-- BUTTONS -->
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
            <!-- ACCEPTED REQUEST -->
            <div id="midCarousel" class="carousel slide" data-bs-wrap="false">
                <div class="carousel-inner mb-2">
                    @forelse($acceptedRequests->chunk(2) as $index => $chunk)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="row g-3">
                            @foreach($chunk as $request)
                            <!-- CARDS -->
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
                                        data-accname="John Doe"
                                        data-accbrgy="Brgy. 123"
                                        data-accwaste="Recyclable"
                                        data-accquantity="1kg"
                                        data-accdate="January 1, 2025"
                                        data-acctime="10:00 AM"
                                        data-acctruck="ABC 1234 (5-ton capacity)">
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
                <!-- BUTTONS -->
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
                <!-- COMPLETED REQUEST -->
                <div class="card-bot">
                    <div class="card-header-with-link">
                        <h2 class="font-extrabold" style="color: var(--color-light-olive) ">Completed Request</h2>
                    </div>

                    <!-- CARDS -->
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

<!-- REQUEST DETAILS MODAL -->
<div id="requestModal" class="modal-overlay" style="display: none;">
    <div class="modal-popup">
        <button class="modal-close-btn" onclick="closeRequestModal()">&times;</button>

        <form id="acceptRequestForm" method="POST" action="">
            @csrf

            <div class="row justify-content-center mb-4 mt-2">
                <div class="modal-circle">
                </div>
                <h2 class="font-extrabold" style="color: var(--color-dark-green)">Request Details</h2>
            </div>

            <div class="card-field-nr">
                <label>Name</label>
                <input id="reqname" type="text" class="form-control" value="" readonly>
            </div>

            <div class="card-field-nr mb-2">
                <label>Resident</label>
                <input id="reqbrgy" type="text" class="form-control" value="" readonly>
            </div>

            <div class="form-row-container">
                <div class="card-field-wq mb-2">
                    <label class="form-label">Waste Type</label>
                    <input id="reqwaste" type="text" class="form-control" value="" readonly>
                </div>

                <div class="card-field-wq mb-2">
                    <label class="form-label">Quantity</label>
                    <input id="reqquantity" type="text" class="form-control" value="" readonly>
                </div>
            </div>

            <div class="card-field-dt">
                <label>Preferred Date</label>
                <input id="reqdate" type="text" class="form-control" value="" readonly>
            </div>

            <div class="card-field-dt mb-8">
                <label>Preferred Time</label>
                <input id="reqtime" type="text" class="form-control" value="" readonly>
            </div>

            <hr class="my-2">

            <label class="font-extrabold" style="color: var(--color-dark-green)">Assigned Truck</label>

            <div class="card-field-t">
                <label>Select Truck <span style="color: red;">*</span></label>
                <select id="reqtruck" name="license_plate" class="form-control" required>
                    <option value="">-- Select Truck --</option>
                </select>
            </div>

            <div class="action-buttons mt-16">
                <button type="button" id="acceptButton" class="btn-accept" onclick="showConfirmation()">
                    Accept
                </button>
                <button type="button" class="btn-decline" onclick="closeRequestModal()">Decline</button>
            </div>
        </form>
    </div>
</div>

<!-- CONFIRM MODAL -->
<div id="confirmModal" class="confirm-overlay" style="display: none;">
    <div class="popup-confirm">
        <div class="circle-pop"></div>
        <h2 class="my-2">Are you sure you want to accept this request?</h2>

        <div class="action-buttons mt-4">
            <button class="btn-confirm" onclick="confirmUpdRequest()">Confirm</button>
            <button class="btn-cancel" onclick="closeConfirmModal()">Cancel</button>
        </div>
    </div>
</div>

<!-- SUCCESS MODAL -->
<div id="confirmSuccessModal" class="success-overlay" style="display: none;">
    <div class="popup-success">
        <div class="popup-box"></div>
        <h2 class="text-4xl font-extrabold my-2">Request Accepted!</h2>

        <div class="action-buttons mt-3">
            <button class="btn-ok" onclick="closeSuccessUpdModal()">Confirm</button>
        </div>
    </div>
</div>

<style>
    :root {
        --color-dark-green: #1f4b2c;
        --color-mid-green: #4d7111;
        --color-orange: #ff9100;
        --color-light-olive: #d5ed9f;
        --color-cream: #fffbe6;

        --color-bg-completed: #f2f9e1;
        --color-bg-inprogress: #ffe9cc;
        --color-bg-assigned: #ffeccc;
        --color-bg-cancelled: #f7ddd9;

        --color-completed: #4d7111;
        --color-inprogress: #ff7b00;
        --color-assigned: #ffa813;
        --color-cancelled: #c2402a;
    }

    body {
        font-family: "Roboto", sans-serif;
    }

    label {
        font-size: 16px;
    }

    .modal-close-btn {
        position: absolute;
        top: 12px;
        right: 20px;
        background: transparent;
        border: none;
        font-size: 32px;
        cursor: pointer;
        color: var(--color-orange);
    }

    .modal-overlay,
    .confirm-overlay,
    .success-overlay {
        position: fixed;
        inset: 0;
        background: rgb(0, 0, 0, 0.50);
        backdrop-filter: blur(10px);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    /* REQUEST DETAILS POPUP*/
    .modal-popup {
        width: 360px;
        height: 710px;
        background: var(--color-cream);
        padding: 24px;
        border-radius: 30px;
        font-size: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
        justify-content: center;
        position: relative;
    }

    .modal-popup h2 {
        text-align: center;
    }

    /* CIRCLE IMAGE CONTAINER */
    .modal-circle,
    .circle-pop {
        flex-shrink: 0;
        width: 80px;
        height: 80px;
        background-color: var(--color-orange);
        border-radius: 50%;
        padding: 0.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 0.75rem;
    }

    /* FORM INPUT CONTAINER*/
    .form-row-container {
        display: flex;
        gap: 24px;
        margin-top: 8px;
    }

    .card-field-nr,
    .card-field-wq,
    .card-field-dt,
    .card-field-t {
        font-weight: 500;
        display: flex;
        justify-content: center;
        margin-top: 8px;
    }

    .card-field-nr,
    .card-field-dt,
    .card-field-t {
        gap: 24px;
        align-items: center;
    }

    .card-field-wq {
        flex-direction: column;
    }

    .card-field-nr label,
    .card-field-wq label,
    .card-field-dt label,
    .card-field-t label {
        min-width: 80px;
        font-size: 12px;
    }

    /* Inputs and selects */
    .card-field-nr input,
    .card-field-wq input,
    .card-field-dt input,
    .card-field-t select {
        flex: 1;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 12px;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 16px;
    }

    .btn-accept,
    .btn-decline {
        width: 100px;
        padding: 10px 24px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: bold;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.25);
    }

    .btn-accept {
        background-image: linear-gradient(to top, #ff9100, #FFA733);
        color: white;
    }

    .btn-decline {
        background: var(--color-cream);
        color: var(--color-orange);
        border: 2px solid;
        border-color: var(--color-orange);
    }

    .btn-accept,
    .btn-decline {
        cursor: pointer;
        position: relative;
        top: 0;
        display: inline-block;
        transition: all 0.2s ease;
    }

    .btn-accept:active,
    .btn-decline:active {
        top: 3px;
        box-shadow: 0 2px 0px var(--color-orange);
        transition: all 0.2s;
    }

    /* CONFIRM AND SUCCESS MODALS */
    .popup-confirm,
    .popup-success {
        background: var(--color-cream);
        color: var(--color-dark-green);
        width: 340px;
        height: 240px;
        padding: 20px;
        border-radius: 30px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
    }

    .popup-confirm h2 {
        font-size: 20px;
        font-weight: bold;
    }

    .popup-box {
        width: 160px;
        height: 100px;
        background: var(--color-orange);
        border-radius: 30px;
    }

    .btn-confirm {
        background-image: linear-gradient(to top, #ff9100, #FFA733);
        color: white;
    }

    .btn-cancel {
        background: var(--color-cream);
        color: var(--color-orange);
        border: 2px solid;
        border-color: var(--color-orange);
        margin-left: 12px;
    }

    .btn-confirm,
    .btn-cancel,
    .btn-ok {
        width: 110px;
        padding: 5px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        position: relative;
        top: 0;
        display: inline-block;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.25);
        transition: all 0.2s ease;
    }

    .btn-confirm:active,
    .btn-cancel:active,
    .btn-ok:active {
        top: 3px;
        box-shadow: 0 2px 0px var(--color-orange);
        transition: all 0.2s;
    }

    .btn-ok {
        background-image: linear-gradient(to top, #ff9100, #FFA733);
        color: white;
    }

    /* Make sure buttons are clickable */
    .btn-details {
        cursor: pointer;
        pointer-events: auto;
        z-index: 10;
        position: relative;
    }
</style>

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
        form.action = `/collector/request/${requestId}/accept`;

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
        // Reload page to refresh the request page
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

    function openAcceptedModal(button) {
        console.log('Opening accepted modal...');
        console.log('Button data:', button.dataset);

        document.getElementById('accname').value = button.dataset.accname || '';
        document.getElementById('accbrgy').value = button.dataset.accbrgy || '';
        document.getElementById('accwaste').value = button.dataset.accwaste || '';
        document.getElementById('accquantity').value = button.dataset.accquantity || '';
        document.getElementById('accdate').value = button.dataset.accdate || '';
        document.getElementById('acctime').value = button.dataset.acctime || '';

        const modal = document.getElementById('acceptedModal');
        modal.style.display = 'flex';

        console.log('Modal displayed');
    }

    function closeAcceptedModal() {
        console.log('Closing modal...');
        const modal = document.getElementById('acceptedModal');
        modal.style.display = 'none';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const requestModal = document.getElementById('requestModal');
        const confirmModal = document.getElementById('confirmModal');
        const successModal = document.getElementById('confirmSuccessModal');
        const acceptedModal = document.getElementById('acceptedModal');

        if (event.target == requestModal) {
            closeRequestModal();
        }
        if (event.target == confirmModal) {
            closeConfirmModal();
        }
        if (event.target == successModal) {
            closeSuccessUpdModal();
        }
        if (event.target == acceptedModal) {
            closeAcceptedModal();
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const statusButtons = document.querySelectorAll(
            '.sched-status-completed, .sched-status-inprogress, .sched-status-assigned, .sched-status-cancelled'
        );

        statusButtons.forEach(button => {
            button.addEventListener('click', () => {
                statusButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
            });
        });
    });
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