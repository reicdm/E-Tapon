@extends('layouts.collector_acceptedreq')
@section('title', 'Collector Accepted Request')
@section('content')
<div class="overlay">
    <div class="popup">
        <button class="close-btn">&times;</button>

        <div class="row justify-content-center mb-8 mt-2">
            <div class="circle">
            </div>
            <h2 class="font-extrabold" style="color: var(--color-dark-green)">Request Details</h2>
        </div>

        <div class="card-field-nr">
            <label>Name</label>
            <input id="name" type="text" class="form-control" value="John Doe" readonly>
        </div>

        <div class="card-field-nr mb-2">
            <label>Resident</label>
            <input id="brgy" type="text" class="form-control" value="Brgy. 123" readonly>
        </div>

        <div class="form-row-container">
            <div class="card-field-wq mb-2">
                <label class="form-label">Waste Type</label>
                <input type="text" class="form-control" value="Recyclable" readonly>
            </div>

            <div class="card-field-wq mb-2">
                <label class="form-label">Quantity</label>
                <input type="text" class="form-control" value="1kg" readonly>
            </div>
        </div>

        <div class="card-field-dt">
            <label>Preferred Date</label>
            <input id="date" type="text" class="form-control" value="January 1, 2025" readonly>
        </div>

        <div class="card-field-dt mb-2">
            <label>Preferred Time</label>
            <input id="time" type="text" class="form-control" placeholder="10:00 AM" readonly>
        </div>

        <label class="font-extrabold" style="color: var(--color-dark-green)">Assigned Truck</label>

        <div class="card-field-t mb-4">
            <label>Select Truck</label>
            <select disabled>
                <option>ABC 1234 (5-ton capacity)</option>
                <option>DEF 9981 (10-ton capacity)</option>
                <option>XYZ 5561 (8-ton capacity)</option>
            </select>
        </div>

        <label class="font-extrabold" style="color: var(--color-dark-green)">Select Status</label>
        <div class="card-sched-status">
            <p class="sched-status-pending">Pending</p>
        </div>

    </div>
</div>
</div>
@endsection