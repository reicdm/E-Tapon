@extends('layouts.main')
@section('title', 'Resident Request')
@section('body-class', 'is-static-page')
@section('content')
<div class="dashboard-mobile-container mt-0">
  <div>
    @if (session('popup_message'))
    <div id="toast-backdrop" class="toast-backdrop">
      <div id="toast-message" class="custom-toast">
        <div class="toast-content">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill toast-icon" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022l-3.477 4.426-2.094-2.094a.75.75 0 1 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
          </svg>

          <p class="toast-message">
            {{ session('popup_message') }}
          </p>
        </div>
      </div>
    </div>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const toast = document.getElementById('toast-message');
        const backdrop = document.getElementById('toast-backdrop');

        // Show pop-up
        if (toast) {
          toast.classList.add('active');
          backdrop.classList.add('active');
        }

        // Hide pop-up after 5 seconds
        setTimeout(function() {
          if (toast) {
            toast.classList.remove('active');
            backdrop.classList.remove('active');
          }
        }, 5000); // 5 seconds
      });
    </script>
    @endif
  </div>


  <div class="content-wrapper">
    <h2 class="title-heading">
      My Special Requests
    </h2>

    <!-- SPECIAL REQUESTS CONTAINER -->
    <div class="requests-list-container">
      @forelse($requests as $request)
      <div class="request-card-item">
        <div class="request-card-details">
          <p class="request-content">{{ $request['type'] }}</p>
          <p class="request-content">{{ $request['schedule'] }}</p>
          <p class="request-content">{{ $request['status'] }}</p>
        </div>
        <div class="request-checkmark-box">
          {{-- Check Icon --}}
          <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
            <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
          </svg>
        </div>
      </div>

      @if (!$loop->last)
      <div class="spacer"></div>
      @endif

      @empty
      <p class="no-request-message"> You have no special requests yet.</p>
      @endforelse
    </div>

    <!-- NEW REQUEST BUTTON -->
    <a href="{{ route('resident.request.create') }}" class="new-request-button">New Request</a>
  </div>
</div>
@endsection