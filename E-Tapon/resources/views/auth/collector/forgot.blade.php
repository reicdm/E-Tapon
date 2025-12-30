@extends('layouts.collector_auth')

@section('title', 'Collector Forgot Password')

@section('content')
<div class="min-h-screen flex flex-col">
    <div class="top-bar w-full relative"></div>

    <div class="bottom-card w-full flex-grow p-8">
        <div class="max-w-md mx-auto">

            <h1 class="text-4xl font-extrabold mb-10 mt-4">
                Forgot Password?
            </h1>

            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert"">
                <ul class=" mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif

            <form method="GET" action="{{ route('collector.forgot.showConfirm') }}">
                @csrf

                <div class="mb-4 form-input-group">
                    <input id="email" type="text" name="email" placeholder="Email">
                </div>

                <div class="my-4 border-t border-gray-400"></div>

                <div class="mb-2 form-input-group">
                    <input id="newpassword" type="password" name="newpassword" placeholder="Enter New Password">
                </div>

                <div class="mb-2 form-input-group">
                    <input id="newpassword_confirmation" type="password" name="newpassword_confirmation" placeholder="Re-Enter New Password">
                </div>

                <button type="submit" class="w-full btn-green-gradient text-lg shadow-xl mt-48">
                    SAVE
                </button>

                <div class="mt-8 try-link text-sm">
                    <a>Try another method</a>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection