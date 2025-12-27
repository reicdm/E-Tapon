@extends('layouts.collector_schedule')

@section('title', 'Collector Schedule')

@section('content')
<div class="min-h-screen flex flex-col p-2">
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
                                <div class="collapsible"
                                    data-type="{{ $item['type'] }}"
                                    data-sched-id="{{ $item['sched_id'] ?? '' }}"
                                    data-brgy-id="{{ $item['brgy_id'] ?? '' }}"
                                    data-request-id="{{ $item['request_id'] ?? '' }}"
                                    data-status="{{ $item['status'] }}">
                                    <div class="card-status-bg-{{ strtolower(str_replace(' ', '', $item['status'])) }} sched-card">
                                        <div class="sched-info">
                                            <p class="card-sched-text-ba"><strong>{{ $item['brgy_name'] }}</strong></p>
                                            <p class="card-sched-text-ba">Truck: {{ $item['license_plate'] }}</p>
                                            @if($item['type'] === 'request' && isset($item['waste_type']))
                                            <p class="card-sched-text-ba">Type: {{ $item['waste_type'] }}</p>
                                            @endif
                                        </div>

                                        <div class="card-sched-status">
                                            <p class="sched-status-{{ strtolower(str_replace(' ', '', $item['status'])) }}">
                                                {{ $item['status'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

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
                                        <button class="btn-update push">Update</button>
                                        <button class="btn-cancel push">Cancel</button>
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

        // Update button functionality
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

                // Disable button during request
                this.disabled = true;
                this.textContent = 'Updating...';

                // Prepare data based on type
                const requestData = {
                    type: type,
                    status: newStatus
                };

                if (type === 'scheduled') {
                    requestData.sched_id = schedId;
                    requestData.brgy_id = brgyId;
                } else {
                    requestData.request_id = requestId;
                }

                // Send AJAX request
                fetch('/collector/schedule/update', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(requestData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message || 'Status updated successfully!');
                            location.reload();
                        } else {
                            alert('Error: ' + (data.message || 'Failed to update status'));
                            this.disabled = false;
                            this.textContent = 'Update';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while updating status');
                        this.disabled = false;
                        this.textContent = 'Update';
                    });
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
</script>
@endpush

@push('styles')
<style>
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
</style>
@endpush