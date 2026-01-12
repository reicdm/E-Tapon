@extends('layouts.resident_auth')
@section('title', 'Welcome Resident!')

@section('content')

<div class="min-h-screen flex flex-col justify-between p-8" style="background-color: #1F4B2C;">

  <!-- Top-left Content -->
  <div class="flex flex-col items-start">
    <p class="text-lg welcome-text" style="color: #D5ED9F;">Kumusta!</p>
    <h1 class="text-5xl md:text-5xl font-extrabold welcome-text" style="color: #D5ED9F;">
      RESIDENT
    </h1>
  </div>

  <div class="resident">
    <img src="{{ asset('icons/03_R.png') }}" class="greet-img">
  </div>

  <!-- Centered Bottom Actions -->
  <div class="w-full max-w-sm flex flex-col items-center mx-auto">
    <!-- Get Started -->
    <a href="{{ route('resident.register') }}" class="btn-orange-gradient w-full text-xl mb-6 text-center">
      Get Started
    </a>

    <!-- Sign In -->
    <p class="text-sm text-center mb-5 mt-4" style="color: #D5ED9F;">
      Already have an account?
      <a href="{{ route('resident.login') }}" class="welcome-signin-link ml-1" style="color: var(--color-link)">
        <u>Sign In</u>
      </a>
    </p>
  </div>

</div>

@endsection