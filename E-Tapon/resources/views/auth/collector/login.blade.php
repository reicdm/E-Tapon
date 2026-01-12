@extends('layouts.collector_auth')
@section('title', 'Collector Login')
@section('content')
<div class="min-h-screen flex flex-col">
  <div class="top-bar w-full">
  </div>

  <div class="bottom-card w-full flex-grow p-8">
    <div class="collector">
      <img src="{{ asset('icons/04_C.png') }}" class="login-img">
    </div>
    <div class="max-w-md mx-auto">

      <h1 class="text-4xl font-extrabold mb-10 mt-4">COLLECTOR LOGIN</h1>

      <form method="POST" action="{{ route('collector.login.submit') }}">
        @csrf
        <!-- EMAIL -->
        <div class="mb-4 form-input-group">
          <input id="email" type="email" name="email" placeholder="Email" required>
        </div>

        <!-- PASSWORD -->
        <div class="mb-2 form-input-group">
          <input id="password" type="password" name="password" placeholder="Password" required>
        </div>

        <!-- FORGOT PASSWORD -->
        <div class="mb-16 forgot-link text-sm text-right">
          <a href="{{ route('collector.forgot') }}" class="forgot-link">Forgot Password?</a>
        </div>

        <!-- LOGIN BUTTON -->
        <button type="submit" class="w-full btn-green-gradient text-lg shadow-xl my-8">
          LOGIN
        </button>
      </form>
    </div>
  </div>
</div>
@endsection