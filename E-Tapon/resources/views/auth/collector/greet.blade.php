@extends('layouts.collector_auth')
@section('title', 'Welcome Collector!')
@section('content')

<div class="min-h-screen flex flex-col justify-between p-8" style="background-color: var(--color-bg-orange);">

  <!-- Top-left Content -->
  <div class="flex flex-col items-start">
    <p class="text-lg welcome-text">Kumusta!</p>
    <h1 class="text-5xl md:text-5xl font-extrabold welcome-text">
      COLLECTOR
    </h1>
  </div>

  <!-- Centered Bottom Actions -->
  <div class="w-full max-w-sm flex flex-col items-center mx-auto">
    <!-- Get Started -->
    <a href="{{ route('collector.login') }}" class="btn-green-gradient w-full text-xl mb-6 text-center">
      Get Started
    </a>
  </div>

</div>
@endsection