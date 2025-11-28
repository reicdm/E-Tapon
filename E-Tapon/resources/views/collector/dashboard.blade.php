@extends('layouts.collector_dashboard')

@section('title', 'Collector Dashboard')

@section('content')
<div class="min-h-screen flex flex-col p-2">
    <div class="mx-auto max-w-4xl w-full p-2">
        <div class="row row-wel justify-content-center">
            <h2 class="font-extrabold" style="color: var(--color-dark-green) ">Welcome, Sample Name!</h2>
            <p style="color: var(--color-dark-green) ">ID: 123-456-789</p>
        </div>

        <div class="row row-con row-cols-2 row-cols-md-2 justify-content-center g-2">
            <div class="col">
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

        <div class="row row-con justify-content-center g-2">
            <div class="col">
                <div class="card-mid">
                    <h2 class="font-extrabold mb-2" style="color: var(--color-dark-green)">Collection Schedule</h2>
                    <div class="row-sched row-cols-3">
                        <a href="{{ route('collector.schedule') }}" class="card-link">
                            <div class="col">
                                <div class="card-data-box-sched">
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
                                <div class="card-data-box-sched">
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
                                <div class="card-data-box-sched">
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
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-con justify-content-center g-2">
            <div class="col">
                <div class="card-bot">
                    <h2 class="font-extrabold" style="color: var(--color-light-olive) ">Request to Approve</h2>
                    <div class="card-sched">
                        <div class="col">
                            <div class="card-data-box-req">
                                <div>
                                    <p class="card-req-text-name">John Doe</p>
                                    <p class="card-req-text-wk">Recyclable</p>
                                    <p class="card-req-text-wk">1kg</p>
                                </div>
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



@endsection