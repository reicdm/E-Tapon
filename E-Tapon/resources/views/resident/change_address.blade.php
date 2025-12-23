@extends('layouts.resident_auth')
@section('title', 'Change Address')
@section('content')
<div class="min-h-screen flex flex-col">
  <div class="top-bar w-full relative"></div>

  <div class="bottom-card w-full flex-grow p-8">
    <div class="max-w-md mx-auto">

      <h1 class="text-4xl font-extrabold mb-10 mt-4">
        Change Address
      </h1>

      <form method="POST" action="{{ route('resident.profile.change_password') }}">
        @csrf

        <!-- OLD PASSWORD -->
        <div class="mb-3 form-input-group">
          <input id="updated_address" type="text" name="updated_address" placeholder="Enter Address">
        </div>

        <!-- NEW PASSWORD -->
        <div class="mb-3 form-input-group">
          <input id="updated_area" type="text" name="updated_area" placeholder="Enter Area / Barangay">
        </div>

        <!-- NEW PASSWORD CONFIRMATION -->
        <div class="mb-3 form-input-group">
          <input id="updated_zip" type="text" name="updated_zip" placeholder="Enter ZIP Code">
        </div>

        <!-- ACTION BUTTONS -->
        <div class="btn-duo-container mt-36">
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
</div>

@endsection