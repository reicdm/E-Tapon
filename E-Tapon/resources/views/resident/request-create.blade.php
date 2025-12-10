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
        <!-- NAME -->
        <div class="mb-4 form-input-group">
          <input id="name" type="text" name="name" placeholder="Resident Name">
        </div>

        <!-- ADDRESS -->
        <div class="mb-4 form-input-group">
          <input id="address" type="text" name="address" placeholder="Address">
        </div>

        <!-- AREA/BRGY. -->
        <div class="mb-4 form-input-group">
          <input id="area_brgy" type="text" name="area_brgy" placeholder="Area/Brgy.">
        </div>

        <!-- PREFERRED DATE -->
        <div class="mb-4 form-input-group">
          <input id="pref_date" type="text" onfocus="(this.type='date')" name="pref_date" placeholder="Preferred Date">
        </div>

        <!-- PREFERRED TIME -->
        <div class="mb-4 form-input-group">
          <input id="pref_time" type="text" onfocus="(this.type='time')" name="pref_time" placeholder="Preferred Time">
        </div>

        <!-- <div class="line-divider"></div> -->

        <h3 class="waste-type-heading">Select Waste Type</h3>



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
              O
            </div>
            <p class="trash-type-name">Bio</p>
          </label>

          <!-- NON-BIODEGRADABLE -->
          <input type="radio" id="waste_nonbio" name="waste_type" value="Non-Biodegradable" class="hidden-radio" required>
          <label for="waste_nonbio" class="trash-type-card overview-card-layout-compact">
            <div class="icon-box-primary">O</div>
            <p class="trash-type-name">Non-Bio</p>
          </label>
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