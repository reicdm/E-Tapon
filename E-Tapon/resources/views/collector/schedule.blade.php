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

                    <div class="schedule-day is-current">
                        <!-- DATE -->
                        <div class="date-col mr-6">
                            <div class="day">19</div>
                            <div class="week">Thu</div>
                        </div>

                        <!-- CARDS -->
                        <div class="task-card">
                            <button class="collapsible">
                                <div class="card-status-bg-completed sched-card">
                                    <div class="sched-info">
                                        <p class="card-sched-text-ba"><strong>Barangay 123</strong></p>
                                        <p class="card-sched-text-ba">Truck: ABC 1234</p>
                                    </div>

                                    <div class="card-sched-status">
                                        <p class="sched-status-completed">Completed</p>
                                    </div>
                                </div>
                            </button>
                            <div class="clicked-status-completed">
                                <hr class="mb-2">
                                <h4 class="update-title">Update Status</h4>

                                <!-- STATUS OPTIONS -->
                                <div class="status-options mb-4">
                                    <button type="button" class="upd-status-assigned" data-status="assigned">
                                        Assigned
                                    </button>

                                    <button type="button" class="upd-status-cancelled" data-status="cancelled">
                                        Cancelled
                                    </button>

                                    <button type="button" class="upd-status-inprogress" data-status="in_progress">
                                        In Progress
                                    </button>

                                    <button type="button" class="upd-status-completed" data-status="completed">
                                        Completed
                                    </button>
                                </div>

                                <!-- ACTION BUTTONS -->
                                <div class="status-actions">
                                    <button class="btn-update push">Update</button>
                                    <button class="btn-cancel push">Cancel</button>
                                </div>
                            </div>

                            <button class="collapsible">
                                <div class="card-status-bg-inprogress sched-card">
                                    <div class="sched-info">
                                        <p class="card-sched-text-ba"><strong>Barangay 123</strong></p>
                                        <p class="card-sched-text-ba">Truck: ABC 1234</p>
                                    </div>

                                    <div class="card-sched-status">
                                        <p class="sched-status-inprogress">In Progress</p>
                                    </div>
                                </div>
                            </button>
                            <div class="clicked-status-inprogress">
                                <hr class="mb-2">
                                <h4 class="update-title">Update Status</h4>

                                <!-- STATUS OPTIONS -->
                                <div class="status-options mb-4">
                                    <button type="button" class="upd-status-assigned" data-status="assigned">
                                        Assigned
                                    </button>

                                    <button type="button" class="upd-status-cancelled" data-status="cancelled">
                                        Cancelled
                                    </button>

                                    <button type="button" class="upd-status-inprogress" data-status="in_progress">
                                        In Progress
                                    </button>

                                    <button type="button" class="upd-status-completed" data-status="completed">
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

                    <div class="schedule-day mt-3">
                        <!-- DATE -->
                        <div class="date-col mr-6">
                            <div class="day">20</div>
                            <div class="week">Fri</div>
                        </div>

                        <!-- CARDS -->
                        <div class="task-card">
                            <div class="collapsible">
                                <div class="card-status-bg-assigned sched-card">
                                    <div class="sched-info">
                                        <p class="card-sched-text-ba"><strong>Barangay 123</strong></p>
                                        <p class="card-sched-text-ba">Truck: ABC 1234</p>
                                    </div>

                                    <div class="card-sched-status">
                                        <p class="sched-status-assigned">Assigned</p>
                                    </div>
                                </div>
                            </div>
                            <div class="clicked-status-assigned">
                                <hr class="mb-2">
                                <h4 class="update-title">Update Status</h4>

                                <!-- STATUS OPTIONS -->
                                <div class="status-options mb-4">
                                    <button type="button" class="upd-status-assigned" data-status="assigned">
                                        Assigned
                                    </button>

                                    <button type="button" class="upd-status-cancelled" data-status="cancelled">
                                        Cancelled
                                    </button>

                                    <button type="button" class="upd-status-inprogress" data-status="in_progress">
                                        In Progress
                                    </button>

                                    <button type="button" class="upd-status-completed" data-status="completed">
                                        Completed
                                    </button>
                                </div>

                                <!-- ACTION BUTTONS -->
                                <div class="status-actions">
                                    <button class="btn-update push">Update</button>
                                    <button class="btn-cancel push">Cancel</button>
                                </div>
                            </div>

                            <div class="collapsible">
                                <div class="card-status-bg-cancelled sched-card">
                                    <div class="sched-info">
                                        <p class="card-sched-text-ba"><strong>Barangay 123</strong></p>
                                        <p class="card-sched-text-ba">Truck: ABC 1234</p>
                                    </div>

                                    <div class="card-sched-status">
                                        <p class="sched-status-cancelled">Cancelled</p>
                                    </div>
                                </div>
                            </div>
                            <div class="clicked-status-cancelled">
                                <hr class="mb-2">
                                <h4 class="update-title">Update Status</h4>

                                <!-- STATUS OPTIONS -->
                                <div class="status-options mb-4">
                                    <button type="button" class="upd-status-assigned" data-status="assigned">
                                        Assigned
                                    </button>

                                    <button type="button" class="upd-status-cancelled" data-status="cancelled">
                                        Cancelled
                                    </button>

                                    <button type="button" class="upd-status-inprogress" data-status="in_progress">
                                        In Progress
                                    </button>

                                    <button type="button" class="upd-status-completed" data-status="completed">
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
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
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
    });

    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.maxHeight) {
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
            }
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const statusButtons = document.querySelectorAll(
            '.upd-status-completed, .upd-status-inprogress, .upd-status-assigned, .upd-status-cancelled'
        );

        statusButtons.forEach(button => {
            button.addEventListener('click', () => {
                statusButtons.forEach(btn => btn.classList.remove('active'));

                button.classList.add('active');
            });
        });
    });

    document.querySelectorAll('.collapsible').forEach(button => {
        button.addEventListener('click', function() {
            const content = this.nextElementSibling;

            if (content.classList.contains('clicked-status-open')) {
                content.style.maxHeight = null;
                content.classList.remove('clicked-status-open');
            } else {
                content.classList.add('clicked-status-open');
                content.style.maxHeight = content.scrollHeight + "px";
            }
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