@extends('layouts.main_r_profile')
@section('title', 'Profile')
@section('content')

<div class="dashboard-mobile-container mt-0">
  <div class="content-wrapper">

    <div class="right-icon-container">
      <!-- PROFILE EDIT ICON -->
      <a class="edit-icon-link" href="{{ route('resident.profile.edit') }}" aria-label="Account Profile">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
        </svg>
      </a>
    </div>

    <!-- PFP AND NAME -->
    <div class="justify-center text-center my-3">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="170" height="170" fill="currentColor">
        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.93 0 3.5 1.57 3.5 3.5S13.93 12 12 12s-3.5-1.57-3.5-3.5S10.07 
      5 12 5zm0 14.2c-2.5 0-4.71-1.28-6-3.21.03-1.99 4.03-3.08 6-3.08 1.96 0 5.97 1.09 6 3.08-1.29 1.93-3.5 3.21-6 3.21z" />
      </svg>

      <h2 class="fw-bold fs-1 mb-4">Sample Name</h2>
    </div>

    <!-- FIELDS -->
    <div class="requests-list-container mb-4">
      <div class="mb-3 request-card-item">
        <p class="request-content">First Name</p>
      </div>

      <div class="mb-3 request-card-item">
        <p class="request-content">Middle Name</p>
      </div>

      <div class="mb-3 request-card-item">
        <p class="request-content">Last Name</p>
      </div>

      <div class="mb-3 request-card-item">
        <p class="request-content">Date of Birth</p>
      </div>

      <div class="mb-3 request-card-item">
        <p class="request-content">Phone Number</p>
      </div>

      <div class="mb-3 request-card-item">
        <p class="request-content">Email Address</p>
      </div>

      <div class="mb-3 request-card-item">
        <p class="request-content">Address | Area | ZIP Code</p>
      </div>

      <div class="request-card-item">
        <p class="request-content">Password</p>
      </div>
    </div>

    <button class="btn-full-orange-border">Delete Account</button>
  </div>
</div>
@endsection