@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
<div class="dashboard-mobile-container mt-0">
  <div class="content-wrapper">

    <h2 class="title-heading">
      Welcome, {{ auth()->user()->name ?? 'Sample Name' }}
    </h2>

    <!-- OVERVIEW CARDS -->
    <div class="metric-grid">
      <!-- Requests -->
      <div class="overview-card-layout">
        <h5 class="white-card-label">Requests</h5>
        <p class="white-card-sub-label">Pending/Approved</p>
        <div class="card-inner-box">XX</div>
      </div>

      <!-- Schedule -->
      <div class="overview-card-layout">
        <h5 class="white-card-label">Schedule</h5>
        <p class="white-card-sub-label">General Waste</p>
        <div class="schedule-bg">
          <div class="card-inner-box-schedule metric-schedule-box mt-4">
            <span class="schedule-day-label">Thursday</span>
            <p style="font-size: 1rem; margin-top: 15px;">Sept</br>
              XX</p>
          </div>
        </div>
      </div>

      <!-- Collections -->
      <div class="overview-card-layout">
        <h5 class="white-card-label">Collections</h5>
        <p class="white-card-sub-label">Completed</p>
        <div class="card-inner-box">XX</div>
      </div>
    </div>

    <!-- UPCOMING EVENTS -->
    <div class="card-metric-dark">
      <div class="green-card-label">
        <h5 class="white-card-label">Upcoming Collections</h5>
        <a href="{{ route('resident.schedule') }}" class="white-link">View all &rarr;</a>
      </div>

      @foreach($upcoming as $collection)
      <div class="card-metric-dark-inner ">
        <div class="collection-icon">
          {{-- Trash Icon --}}
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
          </svg>
        </div>
        <div class="green-card-sub-label-wrapper">
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
          <h5 class="white-card-label">Need Special Collection?</h5>
          <p class="white-card-sub-label">Request pickup for bulky items or extra trash</p>
        </div>

        <!-- Arrow -->
        <div class="cta-button">
          <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
          </svg>
        </div>
      </div>
    </a>
  </div>
</div>
@endsection