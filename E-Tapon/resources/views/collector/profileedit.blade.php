@extends('layouts.collector_profile')

@section('title', 'Collector Profile')

@section('content')
<div class="min-h-screen flex flex-col p-2">
    <div class="mx-auto max-w-4xl w-full p-2">
        <div class="profile-header">
            <a href="{{ route('collector.profile') }}" class="icon-left">
                <img src="{{ asset('icons/O_back.png') }}" alt="Back">
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
        <form action="{{ route('collector.profile.confirm') }}" method="GET">
            <div class="row row-con justify-content-center g-2">
                <div class="col">
                    <div class="card-con">

                        <div class="card-field">
                            <input id="name" type="text" class="form-control" value="{{ $profile['firstname'] }}" readonly>
                        </div>

                        <div class="card-field">
                            <input id="name" type="text" class="form-control" value="{{ $profile['middlename'] }}" readonly>
                        </div>

                        <div class="card-field">
                            <input id="name" type="text" class="form-control" value="{{ $profile['lastname'] }}" readonly>
                        </div>

                        <div class="card-field-edit">
                            <input id="name" name="contact_number" type="text" class="form-control" placeholder="Phone Number" value="{{ old('contact_number', $profile['contact_number']) }}">
                        </div>

                        <div class="card-field-edit">
                            <input id="name" name="email" type="text" class="form-control" placeholder="Email Address" value="{{ old('email', $profile['email']) }}">
                        </div>

                        <a href="{{ route('collector.forgot') }}" style="text-decoration: none;">
                            <div class="card-field-edit">
                                <input id="name" name="password" type="password" class="form-control" placeholder="Password" value="{{ $profile['password_display'] }}">
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="action-buttons mt-4">
                <button type="submit" class="btn-save">Save</button>
                <a href="{{ route('collector.profile') }}"><button class="btn-cancel">Cancel</button></a>
            </div>
        </form>
    </div>
</div>
@endsection