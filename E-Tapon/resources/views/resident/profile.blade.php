@extends('layouts.main_r_profile')
@section('title', 'Profile')
@section('content')

<div class="dashboard-mobile-container mt-0">
    <div class="content-wrapper">

        @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
        @endif
        <div class="right-icon-container">
            <!-- PROFILE EDIT ICON -->
            <a class="edit-icon-link" href="{{ route('resident.profile.edit') }}" aria-label="Edit Profile">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                </svg>
            </a>
        </div>

        <!-- PFP AND NAME -->
        <div class="justify-center text-center my-3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="170" height="170" fill="currentColor">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.93 0 3.5 1.57 3.5 3.5S13.93 12 12 12s-3.5-1.57-3.5-3.5S10.07 5 12 5zm0 14.2c-2.5 0-4.71-1.28-6-3.21.03-1.99 4.03-3.08 6-3.08 1.96 0 5.97 1.09 6 3.08-1.29 1.93-3.5 3.21-6 3.21z" />
            </svg>

            <!-- ✅ REAL FIRST NAME -->
            <h2 class="fw-bold fs-1 mb-4">{{ $userData->firstname }} {{ $userData->lastname }}</h2>
        </div>

        <!-- FIELDS -->
        <div class="requests-list-container mb-4">
            <div class="mb-3 request-card-item">
                <p class="request-content"><strong>First Name:</strong> {{ $userData->firstname }}</p>
            </div>

            <div class="mb-3 request-card-item">
                <p class="request-content"><strong>Middle Name:</strong> {{ $userData->middlename ?? 'N/A' }}</p>
            </div>

            <div class="mb-3 request-card-item">
                <p class="request-content"><strong>Last Name:</strong> {{ $userData->lastname }}</p>
            </div>

            <div class="mb-3 request-card-item">
                <p class="request-content"><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($userData->date_of_birth)->format('F d, Y') }}</p>
            </div>

            <div class="mb-3 request-card-item">
                <p class="request-content"><strong>Phone Number:</strong> {{ $userData->contact_no }}</p>
            </div>

            <div class="mb-3 request-card-item">
                <p class="request-content"><strong>Email Address:</strong> {{ $userData->email }}</p>
            </div>

            <div class="mb-3 request-card-item">
                <p class="request-content"><strong>Address:</strong> {{ $userData->street_address }}, {{ $userData->area_barangay }} {{ $userData->zip_code ?? '' }}</p>
            </div>

            <div class="request-card-item">
                <p class="request-content"><strong>Password:</strong> ********</p>
            </div>
        </div>

        <!-- ✅ LOG OUT BUTTON -->
        <form method="POST" action="{{ route('resident.logout') }}" class="d-block"
            onsubmit="return confirm('Are you sure you want to log out?');">
            @csrf
            <button type="submit" class="btn-full-orange-border w-100">Log Out</button>
        </form>

        <!-- DELETE ACCOUNT BUTTON -->
        <form id="delete-account-form" method="POST" action="{{ route('resident.account.delete') }}" style="display: none;">
            @csrf
            @method('DELETE')
        </form>

        <button type="button" class="btn-full-orange-border mt-2 w-100 text-danger"
            onclick="confirmDeleteAccount()">
            Delete Account
        </button>

        <script>
            function confirmDeleteAccount() {
                if (confirm("⚠️ Do you want to delete your account? This action cannot be undone.")) {
                    document.getElementById('delete-account-form').submit();
                }
            }
        </script>

        <!-- Optional: Delete Account (below logout) -->
        <!--
    <button class="btn-full-orange-border mt-2">Delete Account</button>
    -->

    </div>
</div>
@endsection