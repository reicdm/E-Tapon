@extends('layouts.selectrole')

@section('title', 'Choose User')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4">
  <div class="max-w-4xl w-full text-center">
    <h1 class="text-6xl font-black text-gray-800 mb-4">E-Tapon</h1>
    <p class="text-xl text-gray-600 mb-12">Select your role to proceed to the system.</p>

    <div class="flex flex-col md:flex-row gap-8">

      <!-- RESIDENT BUTTON -->
      <a href="{{ url('/resident/greet') }}" class="resident-card">
        <div class="flex items-center gap-6">
          <img src="https://cdn-icons-png.flaticon.com/512/522/522297.png" class="user-img">
          <div class="flex flex-col items-center">
            <i class="fas fa-home text-6xl mb-4"></i>
            <h2 class="text-3xl font-bold mb-2">RESIDENT</h2>
            <p class="text-sm font-light opacity-80">Log in to schedule pickups, monitor pickups, and manage waste.</p>
          </div>
        </div>
      </a>

      <!-- COLLECTOR BUTTON -->
      <a href="{{ url('/collector/greet') }}" class="collector-card">
        <div class="flex items-center gap-6">
          <img src="https://cdn-icons-png.flaticon.com/512/522/522297.png" class="user-img">
          <div class="flex flex-col items-center">
            <i class="fas fa-truck text-6xl mb-4"></i>
            <h2 class="text-3xl font-bold mb-2">COLLECTOR</h2>
            <p class="text-sm font-light opacity-80">Access routes, view assigned pickups, and manage schedules.</p>
          </div>
        </div>
      </a>

    </div>
  </div>
</div>
@endsection