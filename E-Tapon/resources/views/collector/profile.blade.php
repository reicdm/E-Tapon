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
            <h2 class="font-extrabold">Sample Name</h2>
        </div>

        <!-- FIELD -->
        <div class="row row-con justify-content-center g-2">
            <div class="col">
                <div class="card-con">

                    <div class="card-field">
                        <input id="name" type="text" class="form-control" value="First Name" readonly>
                    </div>

                    <div class="card-field">
                        <input id="name" type="text" class="form-control" value="Middle Name" readonly>
                    </div>

                    <div class="card-field">
                        <input id="name" type="text" class="form-control" value="Last Name" readonly>
                    </div>

                    <div class="card-field">
                        <input id="name" type="text" class="form-control" value="Date of Birth" readonly>
                    </div>

                    <div class="card-field">
                        <input id="name" type="text" class="form-control" value="Phone Number" readonly>
                    </div>

                    <div class="card-field">
                        <input id="name" type="text" class="form-control" value="Email Address" readonly>
                    </div>

                    <div class="card-field">
                        <input id="name" type="text" class="form-control" value="Address | Area | Zip Code" readonly>
                    </div>

                    <div class="card-field">
                        <input id="name" type="text" class="form-control" value="Password" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection