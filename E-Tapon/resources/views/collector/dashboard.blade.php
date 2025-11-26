@extends('layouts.collector_dashboard')

@section('title', 'Collector Dashboard')

@section('content')
<div class="min-h-screen flex flex-col p-2">
    <div class="mx-auto max-w-4xl w-full p-2">

        <h2 class="font-extrabold" style="color: var(--color-dark-green) ">Welcome, Sample Name!</h2>
        <p style="color: var(--color-dark-green) ">ID: 123-456-789</p>

        <div class="row row-cols-2 row-cols-md-2 g-2 pt-2">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Assigned Area</h6>
                        <div class="card-data-box-area">
                            <p class="card-text">Area: Barangay</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Assigned Truck</h5>
                        <div class="card-data-box-truck">
                            <p class="card-text">Plate no.: ABC 1234</p>
                            <p class="card-text">Capacity: ____</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



@endsection