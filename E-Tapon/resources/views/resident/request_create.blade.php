@extends('layouts.main')
@section('title', 'Create Request')
@section('content')
<div class="dashboard-mobile-container mt-0">
  <div class="content-wrapper">
    <h2 class="title-heading">
      Create New Request
    </h2>

    <div class="request-form-container">

      <form method="POST" action="{{ route('resident.request.submit') }}">
        @csrf

        <!-- PREFERRED DATE -->
        <!-- <h3 class="waste-type-heading">Preferred Date & Time</h3> -->
        <div class="line-divider"></div>
        <div class="mb-4 form-input-group horizontal-input">
          <label for="pref_date" class="input-label-side">Date</label>
          <input id="pref_date" type="date" name="pref_date" placeholder="Preferred Date" required>
        </div>

        <!-- PREFERRED TIME -->
        <div class=" form-input-group horizontal-input">
          <label for="pref_date" class="input-label-side">Time</label>
          <input id="pref_time" type="time" name="pref_time" placeholder="Preferred Time" required>
        </div>

        <div class="line-divider"></div>

        <!-- <h3 class="waste-type-heading">Select Waste Type</h3> -->

        <!-- TRASH TYPE CARDS -->
        <div class="metric-grid trash-type-selection">

          <!-- RECYCLABLE -->
          <input type="radio" id="waste_recyclable" name="waste_type" value="Recyclable" class="hidden-radio" required>
          <label for="waste_recyclable" class="trash-type-card overview-card-layout-compact">
            <div class="icon-box-primary">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-recycle trash-icons" viewBox="0 0 16 16">
                <path d="M9.302 1.256a1.5 1.5 0 0 0-2.604 0l-1.704 2.98a.5.5 0 0 0 .869.497l1.703-2.981a.5.5 0 0 1 .868 0l2.54 4.444-1.256-.337a.5.5 0 1 0-.26.966l2.415.647a.5.5 0 0 0 .613-.353l.647-2.415a.5.5 0 1 0-.966-.259l-.333 1.242zM2.973 7.773l-1.255.337a.5.5 0 1 1-.26-.966l2.416-.647a.5.5 0 0 1 .612.353l.647 2.415a.5.5 0 0 1-.966.259l-.333-1.242-2.545 4.454a.5.5 0 0 0 .434.748H5a.5.5 0 0 1 0 1H1.723A1.5 1.5 0 0 1 .421 12.24zm10.89 1.463a.5.5 0 1 0-.868.496l1.716 3.004a.5.5 0 0 1-.434.748h-5.57l.647-.646a.5.5 0 1 0-.708-.707l-1.5 1.5a.5.5 0 0 0 0 .707l1.5 1.5a.5.5 0 1 0 .708-.707l-.647-.647h5.57a1.5 1.5 0 0 0 1.302-2.244z" />
              </svg>
            </div>
            <p class="trash-type-name">Recyclable</p>
          </label>

          <!-- BIODEGRADABLE -->
          <input type="radio" id="waste_bio" name="waste_type" value="Biodegradable" class="hidden-radio" required>
          <label for="waste_bio" class="trash-type-card overview-card-layout-compact">
            <div class="icon-box-primary">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-leaf trash-icons" viewBox="0 0 16 16">
                <path d="M1.4 1.7c.216.289.65.84 1.725 1.274 1.093.44 2.884.774 5.834.528l.37-.023c1.823-.06 3.117.598 3.956 1.579C14.16 6.082 14.5 7.41 14.5 8.5c0 .58-.032 1.285-.229 1.997q.198.248.382.54c.756 1.2 1.19 2.563 1.348 3.966a1 1 0 0 1-1.98.198c-.13-.97-.397-1.913-.868-2.77C12.173 13.386 10.565 14 8 14c-1.854 0-3.32-.544-4.45-1.435-1.125-.887-1.89-2.095-2.391-3.383C.16 6.62.16 3.646.509 1.902L.73.806zm-.05 1.39c-.146 1.609-.008 3.809.74 5.728.457 1.17 1.13 2.213 2.079 2.961.942.744 2.185 1.22 3.83 1.221 2.588 0 3.91-.66 4.609-1.445-1.789-2.46-4.121-1.213-6.342-2.68-.74-.488-1.735-1.323-1.844-2.308-.023-.214.237-.274.38-.112 1.4 1.6 3.573 1.757 5.59 2.045 1.227.215 2.21.526 3.033 1.158.058-.39.075-.782.075-1.158 0-.91-.288-1.988-.975-2.792-.626-.732-1.622-1.281-3.167-1.229l-.316.02c-3.05.253-5.01-.08-6.291-.598a5.3 5.3 0 0 1-1.4-.811" />
              </svg>
            </div>
            <p class="trash-type-name">Bio</p>
          </label>

          <!-- NON-BIODEGRADABLE -->
          <input type="radio" id="waste_nonbio" name="waste_type" value="Non-Biodegradable" class="hidden-radio trash-icon-non-recyclable" required>
          <label for="waste_nonbio" class="trash-type-card overview-card-layout-compact">
            <div class="icon-box-primary trash-icon-non-recyclable">
              <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-recycle " viewBox="0 0 16 16">
                <path d="M9.302 1.256a1.5 1.5 0 0 0-2.604 0l-1.704 2.98a.5.5 0 0 0 .869.497l1.703-2.981a.5.5 0 0 1 .868 0l2.54 4.444-1.256-.337a.5.5 0 1 0-.26.966l2.415.647a.5.5 0 0 0 .613-.353l.647-2.415a.5.5 0 1 0-.966-.259l-.333 1.242zM2.973 7.773l-1.255.337a.5.5 0 1 1-.26-.966l2.416-.647a.5.5 0 0 1 .612.353l.647 2.415a.5.5 0 0 1-.966.259l-.333-1.242-2.545 4.454a.5.5 0 0 0 .434.748H5a.5.5 0 0 1 0 1H1.723A1.5 1.5 0 0 1 .421 12.24zm10.89 1.463a.5.5 0 1 0-.868.496l1.716 3.004a.5.5 0 0 1-.434.748h-5.57l.647-.646a.5.5 0 1 0-.708-.707l-1.5 1.5a.5.5 0 0 0 0 .707l1.5 1.5a.5.5 0 1 0 .708-.707l-.647-.647h5.57a1.5 1.5 0 0 0 1.302-2.244z" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-ban ban-overlay" viewBox="0 0 16 16">
                <path d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0" />
              </svg>
            </div>
            <p class="trash-type-name">Non-Bio</p>
          </label>
        </div>

        <!-- QUANTITY -->
        <div class="mt-4 form-input-group">
          <input id="qty" type="number" name="qty" placeholder="Quantity (kg)">
        </div>
    </div>

    <!-- ACTION BUTTONS (Submit/Cancel) -->
    <div class="action-buttons-group">



      <!-- CANCEL BUTTON -->
      <button type="button" onclick="window.history.back()" class="btn-white-border text-lg">
        Cancel
      </button>

      <!-- SUBMIT BUTTON -->
      <button type="submit" class="btn-orange-gradient text-lg">
        Submit
      </button>
    </div>
    </form>
  </div>
  @endsection