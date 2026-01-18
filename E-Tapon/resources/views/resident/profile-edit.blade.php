@extends('layouts.main_r_profile')
@section('title', 'Profile')
@section('content')

<div class="dashboard-mobile-container mt-0">
  <div class="content-wrapper">

    <div class="right-icon-container">
      <!-- EXIT EDITING ICON -->
      <a class="edit-icon-link" href="{{ route('resident.profile') }}" aria-label="Account Profile">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
          <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
        </svg>
      </a>
    </div>

    <!-- PFP AND NAME -->
    <div class="justify-center text-center my-3">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="170" height="170" fill="currentColor">
        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.93 0 3.5 1.57 3.5 3.5S13.93 12 12 12s-3.5-1.57-3.5-3.5S10.07 
      5 12 5zm0 14.2c-2.5 0-4.71-1.28-6-3.21.03-1.99 4.03-3.08 6-3.08 1.96 0 5.97 1.09 6 3.08-1.29 1.93-3.5 3.21-6 3.21z" />
      </svg>

      <h2 class="fw-bold fs-1 mb-4">{{ $userData->firstname }} {{ $userData->lastname }}</h2>
    </div>

    <!-- FIELDS -->

    <form method="POST" action="{{ route('resident.profile.update') }}">
      @csrf
      <div class="requests-list-container mb-4">
        <!-- FIRST NAME -->
        <div class="mb-3 form-input-group">
          <input type="text" name="first_name" value="{{ $userData->firstname }}" readonly>

        </div>

        <!-- MIDDLE NAME -->
        <div class="mb-3 form-input-group">
          <input type="text" name="middle_name" value="{{ $userData->middlename }}" readonly>

        </div>

        <!-- LAST NAME -->
        <div class="mb-3 form-input-group">
          <input type="text" name="last_name" value="{{ $userData->lastname }}" readonly>
        </div>

        <!-- DATE OF BIRTH -->
        <div class="mb-3 form-input-group">
          <input type="date" name="date_of_birth" value="{{ $userData->date_of_birth }}" readonly>
        </div>

        <!-- PHONE NUMBER -->
        <div class="mb-3 form-input-group">
          <input type="text" name="phone_number" value="{{ $userData->contact_no }}" readonly>
        </div>

        <!-- EMAIL ADDRESS -->
        <div class="mb-3 form-input-group">
          <input type="text" name="email" value="{{ $userData->email }}" readonly>
        </div>

        <!-- ADDRESS -->
        <a href="{{ route('resident.profile.change_address') }}" class="block text-decoration-none">
          <div class="mb-3 request-card-item">
            <div class="cta-text">
              <p class="request-content">Address | Area | ZIP Code</p>
            </div>

            <!-- Arrow -->
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
            </svg>
          </div>
        </a>

        <!-- PASSWORD -->
        <a href="{{ route('resident.profile.change_password') }}" class="block text-decoration-none">
          <div class="request-card-item">
            <div class="cta-text">
              <p class="request-content">Password</p>
            </div>

            <!-- Arrow -->
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
            </svg>
          </div>
        </a>
      </div>


      <!-- ACTION BUTTONS -->
      <div class="btn-duo-container">
        <a href="{{ route('resident.profile.edit') }}" class="btn-cancel">
          CANCEL
        </a>

        <button type="submit" class="btn-save">
          SAVE
        </button>
      </div>
    </form>

  </div>
</div>
@endsection