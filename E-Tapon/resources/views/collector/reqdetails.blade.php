@extends('layouts.collector_reqdetails')
@section('title', 'Collector Request to Approve')
@section('content')
<div class="overlay">
    <div class="popup">
        <button class="close-btn">&times;</button>

        <div class="row justify-content-center mb-4 mt-2">
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

        <div class="card-field-dt mb-8">
            <label>Preferred Time</label>
            <input id="time" type="text" class="form-control" placeholder="10:00 AM" readonly>
        </div>

        <hr class="my-2">

        <label class="font-extrabold" style="color: var(--color-dark-green)">Assigned Truck</label>

        <div class="card-field-t">
            <label>Select Truck</label>
            <select>
                <option>ABC 1234 (5-ton capacity)</option>
                <option>DEF 9981 (10-ton capacity)</option>
                <option>XYZ 5561 (8-ton capacity)</option>
            </select>
        </div>

        <div class="action-buttons mt-16">
            <button class="btn-accept">Accept</button>
            <button class="btn-decline">Decline</button>
        </div>


    </div>
</div>
</div>
@endsection