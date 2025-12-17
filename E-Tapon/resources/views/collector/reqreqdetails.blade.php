@extends('layouts.collector_reqdetails')

@section('title', 'Collector Request to Approve')

@section('content')
<div class="overlay">
    <div class="popup">
        <a href="{{ route('collector.request') }}" class="close-btn" style="text-decoration: none;">&times;</a>

        <div class="row justify-content-center mb-4 mt-2">
            <div class="circle">
            </div>
            <h2 class="font-extrabold" style="color: var(--color-dark-green)">Request Details</h2>
        </div>

        <div class="card-field-nr">
            <label>Name</label>
            <input id="name" type="text" class="form-control" value="{{ $requestData->resident_name }}" readonly>
        </div>

        <div class="card-field-nr mb-2">
            <label>Resident</label>
            <input id="brgy" type="text" class="form-control" value="{{ $requestData->brgy_name }}" readonly>
        </div>

        <div class="form-row-container">
            <div class="card-field-wq mb-2">
                <label class="form-label">Waste Type</label>
                <input type="text" class="form-control" value="{{ $requestData->waste_type }}" readonly>
            </div>

            <div class="card-field-wq mb-2">
                <label class="form-label">Quantity</label>
                <input type="text" class="form-control" value="{{ number_format($requestData->quantity, 2) }}kg" readonly>
            </div>
        </div>

        <div class="card-field-dt">
            <label>Preferred Date</label>
            <input id="date" type="text" class="form-control" value="{{ \Carbon\Carbon::parse($requestData->preferred_date)->format('F d, Y') }}" readonly>
        </div>

        <div class="card-field-dt mb-8">
            <label>Preferred Time</label>
            <input id="time" type="text" class="form-control" placeholder="{{ \Carbon\Carbon::parse($requestData->preferred_time)->format('h:i A') }}" readonly>
        </div>

        <hr class="my-2">

        <label class="font-extrabold" style="color: var(--color-dark-green)">Assigned Truck</label>

        <form action="{{ route('collector.reqdetails.accept', $requestData->request_id) }}" method="POST">
            @csrf
            <div class="card-field-t">
                <label>Select Truck</label>
                <select name="license_plate" required>
                    <option value="">-- Select a truck --</option>
                    @foreach($availableTrucks as $truck)
                    <option value="{{ $truck->license_plate }}">
                        {{ $truck->license_plate }} ({{ number_format($truck->capacity / 1000, 1) }}-ton capacity)
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="action-buttons mt-16">
                <button type="submit" class="btn-accept">Accept</button>
                <button type="button" class="btn-decline" onclick="event.preventDefault(); document.getElementById('decline-form').submit();">Decline</button>
            </div>
        </form>

        <form id="decline-form" action="{{ route('collector.reqreqdetails.decline', $requestData->request_id) }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>
@endsection