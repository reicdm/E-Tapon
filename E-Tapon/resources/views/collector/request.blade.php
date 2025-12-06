@extends('layouts.collector_request')
@section('title', 'Collector Request')
@section('content')

<div class="min-h-screen flex flex-col p-2">
    <div class="mx-auto max-w-4xl w-full p-2">
        <div class="row row-wel justify-content-center">
            <h1 class="font-extrabold" style="color: var(--color-dark-green) ">Request to Approve</h1>
        </div>


        <div id="carouselExampleControls" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row g-3">

                        <div class="col-6 col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Card title 1</h5>
                                    <p class="card-text">Some quick example text to build on the card title.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Card title 2</h5>
                                    <p class="card-text">Some quick example text to build on the card title.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="row g-3">

                        <div class="col-6 col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Card title 1</h5>
                                    <p class="card-text">Some quick example text to build on the card title.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Card title 2</h5>
                                    <p class="card-text">Some quick example text to build on the card title.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div class="row row-con justify-content-center g-2">
                <div class="col">
                    <div class="card-mid">
                        <div class="card-header-with-link">
                            <h2 class="font-extrabold" style="color: var(--color-dark-green) ">Collection Schedule</h2>
                        </div>
                        <div class="row-sched row-cols-3">
                            <a href="{{ route('collector.schedule') }}" class="card-link">
                                <div class="col">
                                    <div class="card-status-bg-pending">
                                        <h2 class="card-sched-text-date">JAN 01</h2>
                                        <div>
                                            <p class="card-sched-text-ba">Brgy. 123</p>
                                            <p class="card-sched-text-ba">ABC 1234</p>
                                        </div>
                                        <div class="card-sched-status">
                                            <p class="sched-status-pending">Pending</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ route('collector.schedule') }}" class="card-link">
                                <div class="col">
                                    <div class="card-status-bg-inprogress">
                                        <h2 class="card-sched-text-date">JAN 01</h2>
                                        <div>
                                            <p class="card-sched-text-ba">Brgy. 123</p>
                                            <p class="card-sched-text-ba">ABC 1234</p>
                                        </div>
                                        <div class="card-sched-status">
                                            <p class="sched-status-inprogress">In progress</p>
                                        </div>
                                    </div>

                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endsection