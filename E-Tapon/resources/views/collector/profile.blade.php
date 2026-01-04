@extends('layouts.collector_profile')

@section('title', 'Collector Profile')

@section('content')
<div class="min-h-screen flex flex-col p-2">
    <div class="mx-auto max-w-4xl w-full p-2">
        <div class="profile-header">
            <a href="{{ route('collector.dashboard') }}" class="icon-left">
                <img src="{{ asset('icons/O_back.png') }}" alt="Back">
            </a>

            <a href="{{ route('collector.profileedit') }}" class="icon-right">
                <img src="{{ asset('icons/O_edit.png') }}" alt="Edit">
            </a>
        </div>

        <!-- PFP AND NAME -->
        <div class="row justify-content-center">
            <div class="circle">
                <img src="{{ asset('icons/O_profile.png') }}">
            </div>
            <h2 class="font-extrabold">{{ $profile['full_name'] }}</h2>
        </div>

        <!-- FIELD -->
        <div class="row row-con justify-content-center g-2 mb-4">
            <div class="col">
                <div class="card-con mb-4">

                    <div class="card-field">
                        <input id="name" type="text" class="form-control" value="{{ $profile['firstname'] }}" readonly>
                    </div>

                    <div class="card-field">
                        <input id="name" type="text" class="form-control" value="{{ $profile['middlename'] }}" readonly>
                    </div>

                    <div class="card-field">
                        <input id="name" type="text" class="form-control" value="{{ $profile['lastname'] }}" readonly>
                    </div>

                    <div class="card-field">
                        <input id="name" type="text" class="form-control" value="{{ $profile['contact_number'] }}" readonly>
                    </div>

                    <div class="card-field">
                        <input id="name" type="text" class="form-control" value="{{ $profile['email'] }}" readonly>
                    </div>

                    <div class="card-field">
                        <input id="name" type="password" class="form-control" value="{{ $profile['password_display'] }}" readonly>
                    </div>
                </div>

                <form method="POST" action="{{ route('collector.logout') }}" class="d-block"
                    onsubmit="return confirm('Are you sure you want to log out?');">
                    @csrf
                    <button type="submit" class="btn-full-orange-border w-100">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection