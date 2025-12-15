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

        <div class="card-field-dt">
            <label>Preferred Time</label>
            <input id="time" type="text" class="form-control" placeholder="10:00 AM" readonly>
        </div>

        <div class="card-field-t">
            <label>Assigned Truck</label>
            <select disabled>
                <option>ABC 1234 (5-ton capacity)</option>
                <option>DEF 9981 (10-ton capacity)</option>
                <option>XYZ 5561 (8-ton capacity)</option>
            </select>
        </div>

        <hr class="my-3">
        <div class="update-status-card">
            <h4 class="update-title">Update Status</h4>
            <!-- STATUS OPTIONS -->
            <div class="status-options mb-4">
                <button type="button" class="sched-status-assigned" data-status="assigned">
                    Assigned
                </button>

                <button type="button" class="sched-status-cancelled" data-status="cancelled">
                    Cancelled
                </button>

                <button type="button" class="sched-status-inprogress" data-status="in_progress">
                    In Progress
                </button>

                <button type="button" class="sched-status-completed" data-status="completed">
                    Completed
                </button>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="status-actions">
                <button class="btn-update push">Update</button>
                <button class="btn-cancel push">Cancel</button>
            </div>

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

    statusButtons.forEach(button => {
        button.addEventListener('click', () => {
            statusButtons.forEach(btn => btn.classList.remove('active'));

            button.classList.add('active');
        });
    });
});
</script>
@endpush
