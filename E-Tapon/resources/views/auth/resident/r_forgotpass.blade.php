@extends('layouts.r_auth')

@section('title', 'Resident Forgot Password')

@section('content')

<div class="min-h-screen flex flex-col">
    <div class="top-bar w-full relative"></div>

    <div class="bottom-card w-full flex-grow p-8">
        <div class="max-w-md mx-auto">

            <h1 class="text-4xl font-extrabold mb-10 mt-4">
                Forgot Password?
            </h1>

            <form method="POST" action="">
                @csrf

                <div class="mb-4 form-input-group">
                    <input id="email" type="text" name="email" placeholder="Email">
                </div>

                <div class="mb-2 form-input-group">
                    <input id="newpassword" type="password" name="newpassword" placeholder="Enter New Password">
                </div>

                <div class="mb-2 form-input-group">
                    <input id="newpassword" type="password" name="newpassword" placeholder="Re-Enter New Password">
                </div>

                <button type="submit" class="w-full btn-orange-gradient text-lg shadow-xl my-8">
                    SAVE
                </button>

                <div class="mb-16 try-link text-sm">
                    <a>Try another method</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endSection