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
                <!-- 1ST SLIDE -->
                <div class="carousel-item active">
                    <div class="row g-3">

                        <!-- CARDS -->
                        <div class="col-6 col-md-6">
                            <div class="card card-top h-100">
                                <div class="card-top-details">
                                    <div class="card-top-circle-date">
                                        <div class="circle-top">
                                            <img src="{{ asset('icons/O_recycle.png') }}" class="wastes-img-top">
                                        </div>
                                        <h2 class="card-top-text-date">JAN 01</h2>
                                    </div>
                                    <div class="card-top-data">
                                        <h5 class="card-top-title">John Doe</h5>
                                        <p class="card-top-text"><b>Waste Type:</b> Recyclable</p>
                                        <p class="card-top-text"><b>Qty:</b> {1kg}</p>
                                    </div>
                                </div>
                                <div class="card-top-button mt-3">
                                    <a href="#">View Details</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="card card-top h-100">
                                <div class="card-top-details">
                                    <div class="card-top-circle-date">
                                        <div class="circle-top">
                                            <img src="{{ asset('icons/O_bio.png') }}" class="wastes-img-top">
                                        </div>
                                        <h2 class="card-top-text-date">JAN 01</h2>
                                    </div>
                                    <div class="card-top-data">
                                        <h5 class="card-top-title">John Doe</h5>
                                        <p class="card-top-text"><b>Waste Type:</b> Biodegradable</p>
                                        <p class="card-top-text"><b>Qty:</b> {1kg}</p>
                                    </div>
                                </div>
                                <div class="card-top-button mt-3">
                                    <a href="#">View Details</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- 2ND SLIDE -->
                <div class="carousel-item">
                    <div class="row g-3">
                        <!-- CARDS -->
                        <div class="col-6 col-md-6">
                            <div class="card card-top h-100">
                                <div class="card-top-details">
                                    <div class="card-top-circle-date">
                                        <div class="circle-top">
                                            <img src="{{ asset('icons/O_nonbio.png') }}" class="wastes-img-top">
                                        </div>
                                        <h2 class="card-top-text-date">JAN 01</h2>
                                    </div>
                                    <div class="card-top-data">
                                        <h5 class="card-top-title">John Doe</h5>
                                        <p class="card-top-text"><b>Waste Type:</b> Non-Biodegradable</p>
                                        <p class="card-top-text"><b>Qty:</b> {1kg}</p>
                                    </div>
                                </div>
                                <div class="card-top-button mt-3">
                                    <a href="#">View Details</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="card card-top h-100">
                                <div class="card-top-details">
                                    <div class="card-top-circle-date">
                                        <div class="circle-top">
                                            <img src="{{ asset('icons/O_recycle.png') }}" class="wastes-img-top">
                                        </div>
                                        <h2 class="card-top-text-date">JAN 01</h2>
                                    </div>
                                    <div class="card-top-data">
                                        <h5 class="card-top-title">John Doe</h5>
                                        <p class="card-top-text"><b>Waste Type:</b> Recyclable</p>
                                        <p class="card-top-text">Qty: {1kg}</p>
                                    </div>
                                </div>
                                <div class="card-top-button mt-3">
                                    <a href="#">View Details</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- BUTTONS -->
            <button class="top-carousel-control-prev" type="button" data-bs-target="#topCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="top-carousel-control-next" type="button" data-bs-target="#topCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- MID CONTAINER -->
        <div class="row row-con justify-content-center g-2">
            <div class="col">
                <div class="mid-card">
                    <div class="row-mid justify-content-center">
                        <h2 class="font-extrabold" style="color: var(--color-dark-green) ">Collection Schedule</h2>
                    </div>

                    <!-- COLLECTION SCHEDULE -->
                    <div id="midCarousel" class="carousel slide" data-bs-wrap="false">
                        <div class="carousel-inner">
                            <!-- 1ST SLIDE -->
                            <div class="carousel-item active">
                                <div class="row g-3">

                                    <!-- CARDS -->
                                    <div class="col-6 col-md-6">
                                        <div class="card card-mid h-100">
                                            <div class="card-mid-details">
                                                <div class="card-mid-circle-date">
                                                    <div class="circle-mid">
                                                        <img src="{{ asset('icons/DG_recycle.png') }}" class="wastes-img-mid">
                                                    </div>
                                                    <h2 class="card-mid-text-date">JAN 01</h2>
                                                </div>
                                                <div class="card-mid-data">
                                                    <h5 class="card-mid-title">John Doe</h5>
                                                    <p class="card-mid-text"><b>Waste Type:</b> Recyclable</p>
                                                    <p class="card-mid-text"><b>Qty:</b> {1kg}</p>
                                                </div>
                                            </div>
                                            <div class="card-mid-button mt-3">
                                                <a href="#">View Details</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-6">
                                        <div class="card card-mid h-100">
                                            <div class="card-mid-details">
                                                <div class="card-mid-circle-date">
                                                    <div class="circle-mid">
                                                        <img src="{{ asset('icons/DG_bio.png') }}" class="wastes-img-mid">
                                                    </div>
                                                    <h2 class="card-mid-text-date">JAN 01</h2>
                                                </div>
                                                <div class="card-mid-data">
                                                    <h5 class="card-mid-title">John Doe</h5>
                                                    <p class="card-mid-text"><b>Waste Type:</b> Biodegradable</p>
                                                    <p class="card-mid-text"><b>Qty:</b> {1kg}</p>
                                                </div>
                                            </div>
                                            <div class="card-mid-button mt-3">
                                                <a href="#">View Details</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- 2ND SLIDE -->
                            <div class="carousel-item">
                                <div class="row g-3">

                                    <!-- CARDS -->
                                    <div class="col-6 col-md-6">
                                        <div class="card card-mid h-100">
                                            <div class="card-mid-details">
                                                <div class="card-mid-circle-date">
                                                    <div class="circle-mid">
                                                        <img src="{{ asset('icons/DG_nonbio.png') }}" class="wastes-img-mid">
                                                    </div>
                                                    <h2 class="card-mid-text-date">JAN 01</h2>
                                                </div>
                                                <div class="card-mid-data">
                                                    <h5 class="card-mid-title">John Doe</h5>
                                                    <p class="card-mid-text"><b>Waste Type:</b> Non-Biodegradable</p>
                                                    <p class="card-mid-text"><b>Qty:</b> {1kg}</p>
                                                </div>
                                            </div>
                                            <div class="card-mid-button mt-3">
                                                <a href="#">View Details</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-6">
                                        <div class="card card-mid h-100">
                                            <div class="card-mid-details">
                                                <div class="card-mid-circle-date">
                                                    <div class="circle-mid">
                                                        <img src="{{ asset('icons/DG_recycle.png') }}" class="wastes-img-mid">
                                                    </div>
                                                    <h2 class="card-mid-text-date">JAN 01</h2>
                                                </div>
                                                <div class="card-mid-data">
                                                    <h5 class="card-mid-title">John Doe</h5>
                                                    <p class="card-mid-text"><b>Waste Type:</b> Recyclable</p>
                                                    <p class="card-mid-text"><b>Qty:</b> {1kg}</p>
                                                </div>
                                            </div>
                                            <div class="card-mid-button mt-3">
                                                <a href="#">View Details</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- BUTTONS -->
                        <button class="mid-carousel-control-prev" type="button" data-bs-target="#midCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="mid-carousel-control-next" type="button" data-bs-target="#midCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
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
                            <div class="card-data-box-req">
                                <div class="circle">
                                    <img src="{{ asset('icons/C_recycle.png') }}" class="waste-img-bot">
                                </div>
                                <div class="card-req-info">
                                    <h2 class="card-req-text-name">John Doe</h2>
                                    <p class="card-req-text-wk">Recyclable, 1kg</p>
                                </div>
                                <div class="card-req-right">
                                    <p class="card-req-text-date">01/01/25</p>
                                    <button type="button" class="btn-completed">Completed</button>
                                </div>
                            </div>
                            <div class="card-data-box-req">
                                <div class="circle">
                                    <img src="{{ asset('icons/C_bio.png') }}" class="waste-img-bot">
                                </div>
                                <div class="card-req-info">
                                    <h2 class="card-req-text-name">John Doe</h2>
                                    <p class="card-req-text-wk">Biodegradable, 1kg</p>
                                </div>
                                <div class="card-req-right">
                                    <p class="card-req-text-date">01/01/25</p>
                                    <button type="button" class="btn-completed">Completed</button>
                                </div>
                            </div>
                            <div class="card-data-box-req">
                                <div class="circle">
                                    <img src="{{ asset('icons/C_nonbio.png') }}" class="waste-img-bot">
                                </div>
                                <div class="card-req-info">
                                    <h2 class="card-req-text-name">John Doe</h2>
                                    <p class="card-req-text-wk">Non-Biodegradable, 1kg</p>
                                </div>
                                <div class="card-req-right">
                                    <p class="card-req-text-date">01/01/25</p>
                                    <button type="button" class="btn-completed">Completed</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection