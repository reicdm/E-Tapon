@extends('layouts.main')

@section('content')
<div class="dashboard-mobile-container">
  <div class="content-wrapper">
    <h2 class="title-heading">
      Welcome, {{ auth()->user()->name ?? 'Sample Name' }}
    </h2>

    <!-- OVERVIEW CARDS -->
    <div class="metric-grid">
      <!-- Requests -->
      <div class="card-metric">
        <h5 class="card-label">Requests</h5>
        <p class="card-sub-label">Pending/Approved</p>
        <div class="metric-value-box">XX</div>
      </div>

      <!-- Schedule -->
      <div class="card-metric">
        <h5 class="card-label">Schedule</h5>
        <p class="card-sub-label">General Waste</p>
        <div class="schedule-bg">
          <div class="schedule-metric-value-box metric-schedule-box mt-4">
            <span class="schedule-day-label">Thursday</span>
            <br>Sept</br>
            XX
          </div>
        </div>
      </div>

      <!-- Collections -->
      <div class="card-metric">
        <h5 class="card-label">Collections</h5>
        <p class="card-sub-label">Completed</p>
        <div class="metric-value-box">XX</div>
      </div>

    </div>

    <!-- UPCOMING EVENTS -->
    <div class="collection-list bg-dark-green">
      <div class="collection-header">
        <h5 class="card-label">Upcoming Collections</h5>
        <a href="{{ route('resident.schedule') }}" class="link">View all &rarr;</a>
      </div>

      @php
      $upcoming = [
      ['date' => 'October 20, 2025', 'truck' => 'TR-003'],
      ['date' => 'October 22, 2025', 'truck' => 'TR-003'],
      ['date' => 'October 24, 2025', 'truck' => 'TR-003'],
      ['date' => 'October 26, 2025', 'truck' => 'TR-003'],
      ];
      @endphp
      @foreach($upcoming as $collection)
      <div class="collection-item">
        <div class="collection-icon">
          {{-- Trash Icon --}}
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 3h6" />
            <path d="M10 6v12" />
            <path d="M14 6v12" />
            <path d="M5 6h14l-1 14H6L5 6z" />
          </svg>
        </div>
        <div class="collection-details-wrapper">
          <p class="collection-date">{{ $collection['date'] }}</p>
          <p class="collection-truck">Truck: {{ $collection['truck'] }}</p>
        </div>
      </div>
      @endforeach
    </div>

    <!-- SPECIAL REQUEST CARD -->
    <a href="request" class="block text-decoration-none">
      <div class="special-request-cta ">
        <div class="cta-text">
          <h5 class="card-label">Need Special Collection?</h5>
          <p class="cta-subtitle">Request pickup for bulky items or extra trash</p>
        </div>
        <div class="cta-button">
          >
        </div>
      </div>
    </a>
  </div>
</div>
@endsection