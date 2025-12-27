@extends('layouts.resident_auth')
@section('title', 'Change Password')
@section('content')
<div class="min-h-screen flex flex-col">
    <div class="top-bar w-full relative"></div>
    <div class="bottom-card w-full flex-grow p-8">
        <div class="max-w-md mx-auto">
            <h1 class="text-4xl font-extrabold mb-10 mt-4">Change Password</h1>

            <form method="POST" action="{{ route('resident.profile.update_password') }}">
                @csrf

                <!-- CURRENT PASSWORD -->
                <!-- <div class="mb-4 form-input-group">
                    <input id="oldpassword" type="password" name="oldpassword" placeholder="Enter Current Password" required>
                </div> -->

                <div class="my-4 border-t border-gray-400"></div>

                <!-- NEW PASSWORD -->
                <div class="mb-3 form-input-group">
                    <input id="newpassword" type="password" name="newpassword" placeholder="Enter New Password" required>
                </div>

                <!-- CONFIRM NEW PASSWORD -->
                <div class="mb-3 form-input-group">
                    <input id="new_password_confirmation" type="password" name="new_password_confirmation" placeholder="Re-Enter New Password" required>
                </div>

                <!-- ACTION BUTTONS -->
                <div class="btn-duo-container mt-36">
                    <a href="{{ route('resident.profile.edit') }}" class="btn-cancel">CANCEL</a>
                    <button type="submit" class="btn-save">SAVE</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection