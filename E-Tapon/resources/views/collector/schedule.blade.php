@extends('layouts.collector_schedule')

@section('title', 'Collector Schedule')

@section('content')
<div id="schedtab" class="min-h-screen flex flex-col p-2">
    <div class="mx-auto max-w-4xl w-full p-2">

        <!-- HEADER -->
        <div class="row row-wel justify-content-center px-2 mb-3">
            <h1 class="font-extrabold" style="color: var(--color-dark-green)">
                Collector Schedule
            </h1>
        </div>

        <!-- CALENDAR CARD -->
        <div id='calendar' class="px-2"></div>

        <!-- STATUS TASK -->
        <div class="row row-con justify-content-center g-2">
            <div class="card-mid">
                <div class="schedule-wrapper">

                    @forelse($scheduleByDate as $dateKey => $dateData)
                    <div class="schedule-day {{ \Carbon\Carbon::parse($dateData['date'])->isToday() ? 'is-current' : '' }} {{ !$loop->first ? 'mt-3' : '' }}">
                        <!-- DATE -->
                        <div class="date-col mr-6">
                            <div class="day">{{ $dateData['day_number'] }}</div>
                            <div class="week">{{ $dateData['day_name'] }}</div>
                        </div>

                        <!-- CARDS -->
                        <div class="task-card">
                            @foreach($dateData['items'] as $item)
                            <div class="{{ !$loop->first ? 'mt-3' : '' }}">
                                <button class="collapsible"
                                    data-type="{{ $item['type'] }}"
                                    data-sched-id="{{ $item['sched_id'] ?? '' }}"
                                    data-brgy-id="{{ $item['brgy_id'] ?? '' }}"
                                    data-request-id="{{ $item['request_id'] ?? '' }}"
                                    data-status="{{ $item['status'] }}">
                                    <div class="card-status-bg-{{ strtolower(str_replace(' ', '', $item['status'])) }} sched-card">
                                        <div class="sched-info">
                                            <p class="card-sched-text-ba"><strong>{{ $item['brgy_name'] }}</strong></p>
                                            <p class="card-sched-text-ba">Truck: {{ $item['license_plate'] }}</p>
                                        </div>

                                        <div class="card-sched-status">
                                            <p class="sched-status-{{ strtolower(str_replace(' ', '', $item['status'])) }}">
                                                {{ $item['status'] }}
                                            </p>
                                        </div>
                                    </div>
                                </button>

                                @if($item['status'] !== 'Completed' && $item['status'] !== 'Cancelled')
                                <div class="clicked-status-{{ strtolower(str_replace(' ', '', $item['status'])) }}">
                                    <hr class="mb-2">
                                    <h4 class="update-title">Update Status</h4>

                                    <!-- STATUS OPTIONS -->
                                    <div class="status-options mb-4">
                                        <button type="button" class="upd-status-assigned {{ $item['status'] === 'Assigned' ? 'active' : '' }}" data-status="Assigned">
                                            Assigned
                                        </button>

                                        <button type="button" class="upd-status-cancelled {{ $item['status'] === 'Cancelled' ? 'active' : '' }}" data-status="Cancelled">
                                            Cancelled
                                        </button>

                                        <button type="button" class="upd-status-inprogress {{ $item['status'] === 'In Progress' ? 'active' : '' }}" data-status="In Progress">
                                            In Progress
                                        </button>

                                        <button type="button" class="upd-status-completed {{ $item['status'] === 'Completed' ? 'active' : '' }}" data-status="Completed">
                                            Completed
                                        </button>
                                    </div>

                                    <!-- ACTION BUTTONS -->
                                    <div class="status-actions">
                                        <button class="btn-update push" onclick="confirmSchRequest()">Update</button>
                                        <button class="btn-cancel push" onclick="closeConfirmSchModal()">Cancel</button>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4">
                        <p class="text-gray-500">No scheduled collections or requests found.</p>
                    </div>
                    @endforelse

                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        // FullCalendar initialization
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            height: 'auto',
            contentHeight: 'auto',
            aspectRatio: 1.35,
            fixedWeekCount: false,
            showNonCurrentDates: true
        });
        calendar.render();

        // Collapsible functionality
        var coll = document.getElementsByClassName("collapsible");
        for (var i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                // Don't allow expanding completed and cancelled tasks
                if (this.dataset.status === 'Completed' || this.dataset.status === 'Cancelled') {
                    return;
                }

                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
        }

        // Status button selection
        const statusButtons = document.querySelectorAll(
            '.upd-status-completed, .upd-status-inprogress, .upd-status-assigned, .upd-status-cancelled'
        );

        statusButtons.forEach(button => {
            button.addEventListener('click', function() {
                const container = this.closest('.status-options');
                const siblingButtons = container.querySelectorAll('.upd-status-completed, .upd-status-inprogress, .upd-status-assigned, .upd-status-cancelled');
                siblingButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Update button functionality - Store data and show confirmation modal
        const updateButtons = document.querySelectorAll('.btn-update');

        updateButtons.forEach(button => {
            button.addEventListener('click', function() {
                const contentDiv = this.closest('[class^="clicked-status-"]');
                const collapsibleButton = contentDiv.previousElementSibling;

                // Get the selected status
                const activeStatusBtn = contentDiv.querySelector('.upd-status-completed.active, .upd-status-inprogress.active, .upd-status-assigned.active, .upd-status-cancelled.active');

                if (!activeStatusBtn) {
                    alert('Please select a status');
                    return;
                }

                const newStatus = activeStatusBtn.dataset.status;
                const type = collapsibleButton.dataset.type;
                const schedId = collapsibleButton.dataset.schedId;
                const brgyId = collapsibleButton.dataset.brgyId;
                const requestId = collapsibleButton.dataset.requestId;

                // Store data in modal for later use
                const modal = document.getElementById('updSchModal');
                modal.dataset.type = type;
                modal.dataset.status = newStatus;
                modal.dataset.schedId = schedId || '';
                modal.dataset.brgyId = brgyId || '';
                modal.dataset.requestId = requestId || '';

                // Show confirmation modal
                document.getElementById('updSchModal').style.display = 'flex';
            });
        });

        // Cancel button functionality
        const cancelButtons = document.querySelectorAll('.btn-cancel');

        cancelButtons.forEach(button => {
            button.addEventListener('click', function() {
                const content = this.closest('[class^="clicked-status-"]');
                const collapsibleButton = content.previousElementSibling;

                // Close the collapsible
                collapsibleButton.classList.remove('active');
                content.style.maxHeight = null;
            });
        });
    });

    function closeConfirmSchModal() {
        document.querySelectorAll('[class*="clicked-status-"]').forEach(content => {
            content.style.maxHeight = null;
            content.classList.remove('clicked-status-open');
        });

        document.querySelectorAll('.collapsible.active').forEach(btn => {
            btn.classList.remove('active');
        });

        document.getElementById('updSchModal').style.display = 'none';
    }

    // THIS IS THE CORRECTED FUNCTION THAT ACTUALLY SUBMITS TO BACKEND
    function confirmPopSchRequest() {
        const modal = document.getElementById('updSchModal');

        // Get stored data from modal
        const type = modal.dataset.type;
        const status = modal.dataset.status;
        const schedId = modal.dataset.schedId;
        const brgyId = modal.dataset.brgyId;
        const requestId = modal.dataset.requestId;

        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("collector.schedule.update") }}';

        // CSRF token
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);

        // Type
        const typeInput = document.createElement('input');
        typeInput.type = 'hidden';
        typeInput.name = 'type';
        typeInput.value = type;
        form.appendChild(typeInput);

        // Status
        const statusInput = document.createElement('input');
        statusInput.type = 'hidden';
        statusInput.name = 'status';
        statusInput.value = status;
        form.appendChild(statusInput);

        // Conditional inputs
        if (type === 'scheduled') {
            const schedIdInput = document.createElement('input');
            schedIdInput.type = 'hidden';
            schedIdInput.name = 'sched_id';
            schedIdInput.value = schedId;
            form.appendChild(schedIdInput);

            const brgyIdInput = document.createElement('input');
            brgyIdInput.type = 'hidden';
            brgyIdInput.name = 'brgy_id';
            brgyIdInput.value = brgyId;
            form.appendChild(brgyIdInput);
        } else {
            const requestIdInput = document.createElement('input');
            requestIdInput.type = 'hidden';
            requestIdInput.name = 'request_id';
            requestIdInput.value = requestId;
            form.appendChild(requestIdInput);
        }

        document.body.appendChild(form);
        form.submit();
    }

    function closeSuccessSchModal() {
        window.location.href = '{{ route("collector.schedule") }}';
    }
</script>
@endpush

@push('styles')
<style>
    :root {
        --color-dark-green: #1f4b2c;
        --color-mid-green: #4d7111;
        --color-orange: #ff9100;
        --color-light-olive: #d5ed9f;
        --color-cream: #fffbe6;
    }

    body {
        font-family: "Roboto", sans-serif;
    }

    /* Calendar Container */
    #calendar {
        width: 380px;
        height: 290px;
        margin: 0 auto;
        background: #FAF8F3;
        padding: 20px;
        border-radius: 16px;
        border: 1px solid #ff9100 !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    /* Remove all borders from FullCalendar */
    .fc {
        border: none !important;
    }

    .fc-theme-standard td,
    .fc-theme-standard th {
        border: none !important;
    }

    /* Header styling */
    .fc-header-toolbar {
        margin-bottom: 6px !important;
        padding-bottom: 4px;
    }

    .fc-toolbar-title {
        font-size: 16px !important;
        font-weight: 600 !important;
        color: #1f4b2c !important;
    }

    /* Navigation buttons */
    .fc-prev-button,
    .fc-next-button {
        background: transparent !important;
        border: none !important;
        color: #ccc !important;
        font-size: 20px !important;
        padding: 0 !important;
        box-shadow: none !important;
    }

    .fc-prev-button:hover,
    .fc-next-button:hover {
        color: #999 !important;
        background: transparent !important;
    }

    .fc-button:focus {
        box-shadow: none !important;
    }

    /* Day headers */
    .fc-col-header-cell {
        background: transparent !important;
        border: none !important;
        padding: 6px 2px !important;
    }

    .fc-col-header-cell-cushion {
        color: #999 !important;
        font-size: 10px !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Calendar grid */
    .fc-scrollgrid {
        border: none !important;
    }

    .fc-scrollgrid td,
    .fc-scrollgrid th {
        border: none !important;
    }

    /* Day cells */
    .fc-daygrid-day {
        background: transparent !important;
        border: none !important;
        padding: 1px !important;
    }

    .fc-daygrid-day-frame {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 28px;
        height: 100%;
        border: none !important;
    }

    .fc-daygrid-day-top {
        justify-content: center;
        flex-grow: 1;
        display: flex;
        align-items: center;
    }

    .fc-daygrid-day-number {
        color: #333 !important;
        font-size: 14px !important;
        font-weight: 500 !important;
        padding: 0 !important;
        text-align: center;
        width: 100%;
    }

    /* Today's date - orange circle */
    .fc-day-today .fc-daygrid-day-number {
        background: #FF8C42 !important;
        color: white !important;
        border-radius: 50%;
        width: 34px;
        height: 34px;
        display: flex !important;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }

    /* Remove today's background color */
    .fc-day-today {
        background: transparent !important;
    }

    /* Days from other months (lighter color) */
    .fc-day-other .fc-daygrid-day-number {
        color: #ddd !important;
    }

    /* Remove event container to prevent layout issues */
    .fc-daygrid-day-events {
        display: none;
    }

    .fc-daygrid-day-bottom {
        display: none;
    }

    /* Ensure weeks display properly */
    .fc-daygrid-body {
        height: 100% !important;
        width: 100% !important;
    }

    .fc-scrollgrid-sync-table {
        width: 100% !important;
        height: 100% !important;
    }

    /* Week rows */
    tbody tr {
        height: 30px;
    }

    /* MODAL STYLES */
    .confirm-overlay,
    .success-overlay {
        position: fixed;
        inset: 0;
        background: rgb(0, 0, 0, 0.50);
        backdrop-filter: blur(10px);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .popup-confirm,
    .popup-success {
        background: var(--color-cream);
        color: var(--color-dark-green);
        width: 340px;
        height: 240px;
        padding: 20px;
        border-radius: 30px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
    }

    .popup-confirm h2 {
        font-size: 20px;
        font-weight: bold;
    }

    .popup-box {
        width: 160px;
        height: 100px;
        background: var(--color-orange);
        border-radius: 30px;
    }

    .circle-pop {
        flex-shrink: 0;
        border-radius: 50%;
        padding: 0.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 80px;
        height: 80px;
        background-color: var(--color-orange);
    }

    .status-actions,
    .action-buttons {
        display: flex;
        justify-content: center;
    }

    .btn-confirm {
        background-image: linear-gradient(to top, #ff9100, #FFA733);
        color: white;
        border: none;
    }

    .btn-cancel {
        background: var(--color-cream);
        color: var(--color-orange);
        border: 2px solid;
        border-color: var(--color-orange);
        margin-left: 12px;
    }

    .btn-ok {
        background-image: linear-gradient(to top, #ff9100, #FFA733);
        color: white;
        border: none;
    }

    .btn-confirm,
    .btn-cancel,
    .btn-ok {
        width: 110px;
        padding: 5px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        position: relative;
        top: 0;
        display: inline-block;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.25);
        transition: all 0.2s ease;
    }

    .btn-confirm:active,
    .btn-cancel:active,
    .btn-ok:active {
        top: 3px;
        box-shadow: 0 2px 0px var(--color-orange);
        transition: all 0.2s;
    }
</style>
@endpush