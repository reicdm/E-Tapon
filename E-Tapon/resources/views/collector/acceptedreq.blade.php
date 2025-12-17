@extends('layouts.collector_acceptedreq')
@section('title', 'Collector Accepted Request')
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

        <div class="card-field-dt">
            <label>Preferred Time</label>
            <input id="time" type="text" class="form-control" value="{{ \Carbon\Carbon::parse($requestData->preferred_time)->format('h:i A') }}" readonly>
        </div>

        <div class="card-field-dt">
            <label>Assigned Truck</label>
            <input id="time" type="text" class="form-control" value="{{ $requestData->license_plate }}" readonly>
        </div>

        <hr class="my-3">
        <div class="update-status-card">
            <h4 class="update-title">Update Status</h4>
            <!-- STATUS OPTIONS -->
            <form action="{{ route('collector.acceptedrequest.updateStatus', $requestData->request_id) }}" method="POST">
                @csrf
                <input type="hidden" name="status" id="selected-status" value="{{ $requestData->status }}">

                <!-- STATUS OPTIONS -->
                <div class="status-options mb-4">
                    <button type="button" class="sched-status-assigned {{ $requestData->status === 'Assigned' ? 'active' : '' }}" data-status="Assigned">
                        Assigned
                    </button>

                    <button type="button" class="sched-status-cancelled {{ $requestData->status === 'Cancelled' ? 'active' : '' }}" data-status="Cancelled">
                        Cancelled
                    </button>

                    <button type="button" class="sched-status-inprogress {{ $requestData->status === 'In Progress' ? 'active' : '' }}" data-status="In Progress">
                        In Progress
                    </button>

                    <button type="button" class="sched-status-completed {{ $requestData->status === 'Completed' ? 'active' : '' }}" data-status="Completed">
                        Completed
                    </button>
                </div>

                <!-- ACTION BUTTONS -->
                <div class="status-actions">
                    <button type="submit" class="btn-update push">Update</button>
                    <a href="{{ route('collector.request') }}" class="btn-cancel push" style="text-decoration: none;">Cancel</a>
                </div>
            </form>
        </div>

    </div>
</div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const statusButtons = document.querySelectorAll(
            '.sched-status-completed, .sched-status-inprogress, .sched-status-assigned, .sched-status-cancelled'
        );
        const hiddenInput = document.getElementById('selected-status'); // get the hidden input

        statusButtons.forEach(button => {
            button.addEventListener('click', () => {
                statusButtons.forEach(btn => btn.classList.remove('active'));

                button.classList.add('active');

                const selectedStatus = button.getAttribute('data-status');
                hiddenInput.value = selectedStatus;
            });
        });
    });
</script>
@endpush