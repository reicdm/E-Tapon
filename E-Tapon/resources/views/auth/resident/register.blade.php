@extends('layouts.resident_auth')
@section('title', 'Register Resident')
@section('content')
<div class="min-h-screen flex flex-col" style="background-color: var(--color-light-olive);">
  <div class="top-bar w-full"></div>

  <div class="bottom-card w-full flex-grow p-8">
    <div class="max-w-md mx-auto">

      <h1 class="text-4xl font-extrabold mb-10 mt-4">SIGN UP RESIDENT</h1>

      <form method="POST" action="{{ route('resident.register.submit') }}">
        @csrf

        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
          <strong>Oops! Please fix the following:</strong>
          <ul class="mt-2 list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <!-- FNAME -->
        <div class="mb-4 form-input-group">
          <input type="text" name="first_name" placeholder="First Name" required>
        </div>

        <!-- MNAME -->
        <div class="mb-4 form-input-group">
          <input type="text" name="middle_name" placeholder="Middle Name">
        </div>

        <!-- LNAME -->
        <div class="mb-4 form-input-group">
          <input type="text" name="last_name" placeholder="Last Name" required>
        </div>

        <!-- DATE OF BIRTH -->
        <div class="mb-4 form-input-group">
          <input type="date" name="date_of_birth" required>
        </div>

        <!-- EMAIL -->
        <div class="mb-4 form-input-group">
          <input type="text" name="email" placeholder="Email" required>
        </div>

        <!-- PHONE NUMBER -->
        <div class="mb-4 form-input-group">
          <input type="text" name="phone_number" placeholder="Phone Number" required>
        </div>

        <!-- ADDRESS -->
        <div class="mb-4 form-input-group">
          <input type="text" name="address" placeholder="Address" required>
        </div>

        <!-- AREA / BARANGAY -->
        <div class="mb-4 form-input-group">
          <select name="area_barangay" required style="background: none; border: none; outline: none; color: var(--color-dark-green); padding-left: 0.75rem; width: 100%;">
            <option value="">Select Barangay</option>
            @foreach($barangays as $brgy)
            <option value="{{ $brgy->brgy_id }}">{{ $brgy->brgy_name }}</option>
            @endforeach
          </select>
        </div>

        <!-- ZIP CODE -->
        <div class="mb-4 form-input-group">
          <input type="text" name="zip_code" placeholder="ZIP Code" required>
        </div>

        <div class="my-6 border-t border-gray-400"></div>

        <!-- CREATE PASSWORD -->
        <div class="mb-4 form-input-group">
          <input type="password" name="password" placeholder="Password" required>
        </div>

        <!-- CONFIRM PASSWORD -->
        <div class="mb-16 form-input-group">
          <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
        </div>

        <!-- SIGN UP BUTTON -->
        <button type="submit" class="w-full btn-orange-gradient text-lg shadow-xl my-8">
          SIGN UP
        </button>
      </form>

      <!-- SIGN IN OPTION -->
      <div class="text-center mb-5">
        <p class="text-sm">
          Already have an account?
          <a href="{{ route('resident.login') }}" class="signin-link ml-1">
            <u>Sign In</u>
          </a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection