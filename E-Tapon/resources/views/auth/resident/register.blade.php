@extends('layouts.auth')
@section('title', 'Register Resident')
@section('content')
<div class="min-h-screen flex flex-col" style="background-color: var(--color-light-olive);">
  <div class="top-bar w-full"></div>

  <div class="bottom-card w-full flex-grow p-8">
    <div class="max-w-md mx-auto">

      <h1 class="text-4xl font-extrabold mb-10 mt-4">Sign Up</h1>

      <form method="POST" action="{{ route('resident.register.submit') }}">
        @csrf
        <div class="mb-4 form-input-group">
          <input type="text" name="first_name" placeholder="First Name" required>
        </div>

        <div class="mb-4 form-input-group">
          <input type="text" name="middle_name" placeholder="Middle Name">
        </div>

        <div class="mb-4 form-input-group">
          <input type="text" name="last_name" placeholder="Last Name" required>
        </div>

        <div class="mb-4 form-input-group">
          <input type="date" name="date_of_birth" required>
        </div>

        <div class="mb-4 form-input-group">
          <input type="text" name="email" placeholder="Email" required>
        </div>

        <div class="mb-4 form-input-group">
          <input type="text" name="phone_number" placeholder="Phone Number" required>
        </div>

        <div class="mb-4 form-input-group">
          <input type="text" name="address" placeholder="Address" required>
        </div>

        <div class="mb-4 form-input-group">
          <input type="text" name="area_barangay" placeholder="Area / Barangay" required>
        </div>

        <div class="mb-4 form-input-group">
          <input type="text" name="zip_code" placeholder="ZIP Code" required>
        </div>

        <div class="my-6 border-t border-gray-400"></div>

        <div class="mb-4 form-input-group">
          <input type="password" name="password" placeholder="Password" required>
        </div>

        <div class="mb-16 form-input-group">
          <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        </div>

        <button type="submit" class="w-full btn-orange-gradient text-lg shadow-xl my-8">
          SIGN UP
        </button>
      </form>

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