@extends('layouts.collector_dashboard')

@section('title', 'Collector Dashboard')

@section('content')
<div class="min-h-screen flex flex-col p-2">
    <div class="mx-auto max-w-4xl w-full p-2">
        <!-- GREETINGS -->
        <div class="row row-wel justify-content-center">
            <h2 class="font-extrabold" style="color: var(--color-dark-green) ">Welcome, Sample Name!</h2>
            <p style="color: var(--color-dark-green) ">ID: 123-456-789</p>
        </div>

        <!-- TOP CONTAINER -->
        <div class="row row-con row-cols-2 row-cols-md-2 justify-content-center g-2">
            <div class="col">
                <!-- ASSIGNED AREA -->
                <div class="card-top">
                    <div class="card-body">
                        <h6 class="card-top-title">Assigned Area</h6>
                        <div class="card-data-box-area">
                            <p class="card-text">Area: Barangay</p>
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
                            <p class="card-text">Plate no.: ABC 1234</p>
                            <p class="card-text">Capacity: ____</p>
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
                        <a href="{{ route('collector.schedule') }}" class="card-link">
                            <div class="col">
                                <div class="card-status-bg-assigned">
                                    <h2 class="card-sched-text-date">JAN 01</h2>
                                    <div>
                                        <p class="card-sched-text-ba">Brgy. 123</p>
                                        <p class="card-sched-text-ba">ABC 1234</p>
                                    </div>
                                    <div class="card-sched-status">
                                        <p class="sched-status-assigned">Assigned</p>
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
                        <a href="{{ route('collector.schedule') }}" class="card-link">
                            <div class="col">
                                <div class="card-status-bg-completed">
                                    <h2 class="card-sched-text-date">JAN 01</h2>
                                    <div>
                                        <p class="card-sched-text-ba">Brgy. 123</p>
                                        <p class="card-sched-text-ba">ABC 1234</p>
                                    </div>
                                    <div class="card-sched-status">
                                        <p class="sched-status-completed">Completed</p>
                                    </div>
                                </div>
                            </div>
                        </a>
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
                            <div class="card-data-box-req">
                                <div class="circle">
                                    <img src="{{ asset('icons/C_recycle.png') }}" class="waste-img">
                                </div>
                                <div class="card-req-info">
                                    <h2 class="card-req-text-name">John Doe</h2>
                                    <p class="card-req-text-wk">Recyclable</p>
                                    <p class="card-req-text-wk">1kg</p>
                                </div>
                                <div class="card-req-right">
                                    <p class="card-req-text-date">01/01/25</p>
                                    <button type="button" class="btn-details">Details</button>
                                </div>
                            </div>
                            
                            <div class="card-data-box-req">
                                <div class="circle">
                                    <img src="{{ asset('icons/C_bio.png') }}" class="waste-img">
                                </div>
                                <div class="card-req-info">
                                    <h2 class="card-req-text-name">John Doe</h2>
                                    <p class="card-req-text-wk">Biodegradable</p>
                                    <p class="card-req-text-wk">1kg</p>
                                </div>
                                <div class="card-req-right">
                                    <p class="card-req-text-date">01/01/25</p>
                                    <button type="button" class="btn-details">Details</button>
                                </div>
                            </div>

                            <div class="card-data-box-req">
                                <div class="circle">
                                    <img src="{{ asset('icons/C_nonbio.png') }}" class="waste-img">
                                </div>
                                <div class="card-req-info">
                                    <h2 class="card-req-text-name">John Doe</h2>
                                    <p class="card-req-text-wk">Non-Biodegradable</p>
                                    <p class="card-req-text-wk">1kg</p>
                                </div>
                                <div class="card-req-right">
                                    <p class="card-req-text-date">01/01/25</p>
                                    <button type="button" class="btn-details">Details</button>
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