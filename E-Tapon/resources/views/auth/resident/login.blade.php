@extends('layouts.resident_auth')
@section('title', 'Resident Login')

@section('content')
<div class="min-h-screen flex flex-col">
  <div class="top-bar w-full"></div>

  <div class="bottom-card w-full flex-grow p-8">
    <div class="max-w-md mx-auto">

      <h1 class="text-4xl font-extrabold mb-10 mt-4">RESIDENT LOGIN</h1>

      <form method="POST" action="{{ route('resident.login.submit') }}">
        @csrf
        <!-- EMAIL -->
        <div class="mb-4 form-input-group">
          <input id="email" type="text" name="email" placeholder="Email">
        </div>

        <!-- PASSWORD -->
        <div class="mb-2 form-input-group">
          <input id="password" type="password" name="password" placeholder="Password">
        </div>

        <!-- FORGOT PASSWORD -->
        <div class="mb-16 signin-link text-sm text-right">
          <a href="{{ route('resident.forgot') }}">Forgot Password?</a>
        </div>

        <!-- LOGIN BUTTON -->
        <button type="submit" class="w-full btn-orange-gradient text-lg shadow-xl my-8">
          LOGIN
        </button>
      </form>

      <!-- SIGN UP OPTION -->
      <div class="text-center">
        <p class="text-sm">
          Don't have an account?
          <a href="{{ route('resident.register') }}" class="signup-link ml-1">
            <u>Sign Up</u>
          </a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection