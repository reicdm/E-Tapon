@extends('layouts.main')
@section('title', 'Resident Schedule')

@section('content')
<div class="dashboard-mobile-container mt-0">
    <div class="content-wrapper">

        <!-- HEADER -->
        <h1 class="title-heading">Collection Schedule</h1>

        <!-- CALENDAR CARD -->
        <div class="calendar-square mb-6">
            <div
                id="calendar"
                class="mb-6"
                data-events="{{ json_encode($scheduleDates ?? []) }}">
            </div>
        </div>

        <!-- STATUS TASK -->
        <div class="row row-con justify-content-center g-2">
            <div class="card-mid">
                <div class="schedule-wrapper">
                    @forelse($schedules as $date => $tasks)
                    @php
                    $carbonDate = \Carbon\Carbon::parse($date);
                    @endphp

                    <!-- DATE -->
                    <div class="schedule-day {{  $carbonDate->isToday() ? 'is-current' : '' }} mb-4">
                        <div class="date-col mr-6 text-center" style="min-width: 50px;">
                            <div class="day font-bold text-2xl leading-none">{{ $carbonDate->format('d') }}</div>
                            <div class="week text-[10px] uppercase opacity-60">{{ $carbonDate->format('D') }}</div>
                        </div>

                        <!-- CARDS LOOP -->
                        <div class="task-card">
                            @foreach($tasks as $task)
                            @php $currentStatusSlug = Str::slug($task['status']); @endphp

                            <!-- CARD -->
                            <button class="collapsible">
                                <div class="sched-card card-status-bg-{{ $currentStatusSlug }}">
                                    <div class="sched-info">
                                        <p class="card-sched-text-ba"><strong>{{ $task['barangay'] }}</strong></p>
                                        <p class="card-sched-text-ba">Truck: {{ $task['truck'] }}</p>
                                    </div>
                                    <div class="card-sched-status">
                                        <span class="sched-status-{{ $currentStatusSlug }}">{{ $task['status'] }}</span>
                                    </div>
                                </div>
                            </button>

                            <div class="clicked-status-{{ $currentStatusSlug }} collapsible-content">

                                <hr class="mb-2 opacity-20">
                                <h4 class="update-title">Update Status</h4>

                                <!-- STATUS OPTIONS -->
                                <div class="status-options mb-4 flex flex-wrap gap-2">
                                    @foreach(['Assigned', 'Cancelled', 'In Progress', 'Completed'] as $statusOption)
                                    <button type="button" class="upd-status-{{ Str::slug($statusOption) }} badge-pill {{ $task['status'] === $statusOption ? 'active' : '' }}">
                                        {{ $statusOption }}
                                    </button>
                                    @endforeach
                                </div>

                                <!-- ACTION BUTTONS -->
                                <div class="status-actions flex gap-2">
                                    <button class="btn-update push">Update</button>
                                    <button class="btn-cancel push">Cancel</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @empty
                    <p class="text-center opacity-50">No schedules found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');

        if (calendarEl) {
            const rawDates = JSON.parse(calendarEl.getAttribute('data-events') || '[]');

            // Create events with custom class for dot styling
            const calendarEvents = rawDates.map(date => ({
                start: date,
                display: 'background', // still needed for non-interactive rendering
                classNames: ['schedule-dot'] // ← Custom CSS class
            }));

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev',
                    center: 'title',
                    right: 'next'
                },
                height: 'auto',
                contentHeight: 'auto',
                aspectRatio: 8.7,
                expandRows: false,
                fixedWeekCount: false,
                showNonCurrentDates: true,
                events: calendarEvents,

                // Optional: Remove default day number styles if needed
                dayCellDidMount: function(info) {
                    // Ensure cell allows absolute positioning
                    info.el.style.position = 'relative';
                }
            });
            calendar.render();
        }

        // Existing collapsible logic
        const coll = document.getElementsByClassName("collapsible");
        for (let i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                let content = this.nextElementSibling;
                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
        }
    });
</script>

<style>
    /* === FULLCALENDAR DOT STYLING === */
    .fc-daygrid-day-frame {
        position: relative;
    }

    /* REMOVE ALL BACKGROUND COLORS FROM SCHEDULED DAYS */
    .fc-bg-event {
        background: transparent !important;
        border: none !important;
    }

    /* Also reset any background from the day cell itself */
    .schedule-dot {
        background: transparent !important;
    }

    /* Dot under date number */
    .schedule-dot::before {
        content: '';
        position: absolute;
        bottom: 1px;
        left: 50%;
        transform: translateX(-50%);
        width: 6px;
        height: 6px;
        background-color: #fff6f1ff;
        /* Removed extra 'ff' (was #ff7b00ff) */
        border-radius: 50%;
        z-index: 2;
    }

    /* Hide event container to prevent layout shift */
    .fc-daygrid-day-events {
        display: none !important;
    }
</style>
@endpush