@extends('layouts.collector_success')

@section('title', 'Collector Forgot Password - Success')

@section('content')

@if(session('success'))
<div class="overlay">
    <div class="popup">
        <div class="popup-box"></div>
        <h2 class="text-4xl font-extrabold mb-10 mt-4">Success!</h2>

        <a href="{{ route('resident.login') }}">
            <button class="ok-btn w-full text-lg shadow-xl mt-6">
                OK
            </button>
        </a>
    </div>
</div>
@endif

@endsection