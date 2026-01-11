@extends('layouts.resident_auth')
@section('title', 'Change Address')
@section('content')
<div class="min-h-screen flex flex-col">
    <div class="top-bar w-full relative"></div>
    <div class="bottom-card w-full flex-grow p-8">
        <div class="max-w-md mx-auto">
            <h1 class="text-4xl font-extrabold mb-10 mt-4">Change Address</h1>

            @error('updated_address')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <form method="POST" action="{{ route('resident.profile.update_address') }}">
                @csrf

                <!-- ADDRESS -->
                <div class="mb-3 form-input-group">
                    <input id="updated_address" type="text" name="updated_address" value="{{ Auth::user()->street_address }}" placeholder="Enter Address" required>
                </div>

                <!-- BARANGAY (Dropdown) -->
                <div class="mb-3 form-input-group">
                    <select name="updated_area" class="w-100" required>
                        <option value="">Select Barangay</option>
                        @foreach($barangays as $brgy)
                        <option value="{{ $brgy->brgy_id }}" {{ Auth::user()->brgy_id == $brgy->brgy_id ? 'selected' : '' }}>
                            {{ $brgy->brgy_name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- ZIP CODE -->
                <div class="mb-3 form-input-group">
                    <input id="updated_zip" type="text" name="updated_zip" value="{{ Auth::user()->zip_code }}" placeholder="Enter ZIP Code">
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