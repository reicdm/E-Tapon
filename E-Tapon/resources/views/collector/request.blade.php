@extends('layouts.collector_request')
@section('title', 'Collector Request')
@section('content')

<div class="min-h-screen flex flex-col p-2">

    <!-- TOP CONTAINER -->
    <div class="mx-auto max-w-4xl w-full p-2">
        <div class="row-top row-top justify-content-center">
            <h1 class="font-extrabold" style="color: var(--color-dark-green) ">Request to Approve</h1>
        </div>

        <!-- REQUEST TO APPROVE -->
        <div id="topCarousel" class="carousel slide" data-bs-wrap="false">
            <div class="carousel-inner">
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
                                <div class="card-top-button mt-3">
                                    <a href="{{ route('collector.reqdetails.showRequestDetails', $request->request_id) }}">View Details</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @empty
                <div class="carousel-item active">
                    <div class="row g-3">
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">No pending requests at the moment</p>
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
        <div class="row row-con justify-content-center g-2">
            <div class="col">
                <div class="mid-card">
                    <div class="row-mid justify-content-center">
                        <h2 class="font-extrabold" style="color: var(--color-dark-green) ">Accepted Request</h2>
                    </div>

                    <!-- ACCEPTED REQUEST -->
                    <div id="midCarousel" class="carousel slide" data-bs-wrap="false">
                        <div class="carousel-inner">
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
                                            <div class="card-mid-button mt-3">
                                                <a href="{{ route('collector.reqdetails.showRequestDetails', $request->request_id) }}">View Details</a>
                                            </div>
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