@extends('layouts.resident_auth')
@section('title', 'Resident Login')

@section('content')
<div class="min-h-screen flex flex-col">
  <div class="top-bar w-full"></div>

  <div class="bottom-card w-full flex-grow p-8">
    <div class="max-w-md mx-auto">

      <h1 class="text-4xl font-extrabold mb-10 mt-4">RESIDENT LOGIN</h1>

      @if ($errors->any())
      <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form method="POST" action="{{ route('resident.login.submit') }}">
        @csrf
        <!-- EMAIL -->
        <div class="mb-4 form-input-group">
          <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        </div>

        <!-- PASSWORD -->
        <div class="mb-2 form-input-group">
          <input id="password" type="password" name="password" placeholder="Password" required>
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