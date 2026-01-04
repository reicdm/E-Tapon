@extends('layouts.collector_profile_edit')

@section('title', 'Collector Profile Edit')

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
        <form id="profileEditForm">
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
                            <input id="contact_number" name="contact_number" type="text" class="form-control" placeholder="Phone Number" value="{{ old('contact_number', $profile['contact_number']) }}">
                            @error('contact_number')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="card-field-edit">
                            <input id="email" name="email" type="text" class="form-control" placeholder="Email Address" value="{{ old('email', $profile['email']) }}">
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <a href="{{ route('collector.forgot') }}" style="text-decoration: none;">
                            <div class="card-field-edit">
                                <input id="password" name="password" type="text" class="form-control"
                                    placeholder="Password"
                                    value="{{ $profile['password_display'] }}"
                                    readonly>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="action-buttons mt-4">
                <button type="button" class="btn-save" onclick="openSaveModal()">Save</button>
                <button type="button" class="btn-cancel" onclick="cancelEdit()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- CONFIRMATION MODAL -->
<div id="saveModal" class="confirm-overlay" style="display: none;">
    <div class="popup-confirm">
        <div class="circle-pop"></div>
        <h2 class="my-2">Are you sure about your changes?</h2>

        <div class="action-buttons mt-4">
            <button class="btn-confirm" onclick="confirmSaveProfile()">Confirm</button>
            <button class="btn-cancel" onclick="closeSaveModal()">Cancel</button>
        </div>
    </div>
</div>

<!-- SUCCESS MODAL -->
<div id="saveSuccessModal" class="success-overlay" style="display: none;">
    <div class="popup-success">
        <div class="popup-box"></div>
        <h2 class="text-4xl font-extrabold my-2">Profile Updated!</h2>

        <div class="action-buttons mt-3">
            <button class="btn-ok" onclick="closeSuccessSaveModal()">Confirm</button>
        </div>
    </div>
</div>

@if(session('show_success_modal'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('saveModal').style.display = 'none';
        document.getElementById('saveSuccessModal').style.display = 'flex';
    });
</script>
@endif

@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        alert('{{ session("error") }}');
    });
</script>
@endif

@endsection

@push('scripts')
<script>
    function openSaveModal() {
        document.getElementById('saveModal').style.display = 'flex';
    }

    function cancelEdit() {
        window.location.href = "{{ route('collector.profile') }}";
    }

    function closeSaveModal() {
        document.getElementById('saveModal').style.display = 'none';
    }

    // THIS IS THE CORRECTED FUNCTION THAT ACTUALLY SUBMITS TO BACKEND
    function confirmSaveProfile() {
        // Get form data
        const contactNumber = document.getElementById('contact_number').value;
        const email = document.getElementById('email').value;

        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("collector.profile.update") }}';

        // CSRF token
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);

        // Contact Number
        const contactInput = document.createElement('input');
        contactInput.type = 'hidden';
        contactInput.name = 'contact_number';
        contactInput.value = contactNumber;
        form.appendChild(contactInput);

        // Email
        const emailInput = document.createElement('input');
        emailInput.type = 'hidden';
        emailInput.name = 'email';
        emailInput.value = email;
        form.appendChild(emailInput);

        document.body.appendChild(form);
        form.submit();
    }

    function closeSuccessSaveModal() {
        window.location.href = "{{ route('collector.profile') }}";
    }
</script>
@endpush

@push('styles')
<style>
    :root {
        --color-dark-green: #1f4b2c;
        --color-mid-green: #4d7111;
        --color-orange: #ff9100;
        --color-light-olive: #d5ed9f;
        --color-cream: #fffbe6;
    }

    body {
        font-family: "Roboto", sans-serif;
    }

    .confirm-overlay,
    .success-overlay {
        position: fixed;
        inset: 0;
        background: rgb(0, 0, 0, 0.50);
        backdrop-filter: blur(10px);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .popup-confirm,
    .popup-success {
        background: var(--color-cream);
        color: var(--color-dark-green);
        width: 340px;
        height: 240px;
        padding: 20px;
        border-radius: 30px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
    }

    .popup-confirm h2 {
        font-size: 20px;
        font-weight: bold;
    }

    .popup-box {
        width: 160px;
        height: 100px;
        background: var(--color-orange);
        border-radius: 30px;
    }

    .circle-pop {
        flex-shrink: 0;
        border-radius: 50%;
        padding: 0.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 80px;
        height: 80px;
        background-color: var(--color-orange);
    }

    .action-buttons {
        display: flex;
        justify-content: center;
    }

    .btn-confirm,
    .btn-save {
        background-image: linear-gradient(to top, #ff9100, #FFA733);
        color: white;
        border: none;
    }

    .btn-cancel {
        background: var(--color-cream);
        color: var(--color-orange);
        border: 2px solid;
        border-color: var(--color-orange);
        margin-left: 12px;
    }

    .btn-ok {
        background-image: linear-gradient(to top, #ff9100, #FFA733);
        color: white;
        border: none;
    }

    .btn-confirm,
    .btn-cancel,
    .btn-save,
    .btn-ok {
        width: 110px;
        padding: 5px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        position: relative;
        top: 0;
        display: inline-block;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.25);
        transition: all 0.2s ease;
    }

    .btn-confirm:active,
    .btn-cancel:active,
    .btn-save:active,
    .btn-ok:active {
        top: 3px;
        box-shadow: 0 2px 0px var(--color-orange);
        transition: all 0.2s;
    }

    .text-danger {
        color: #dc3545;
        font-size: 12px;
        margin-top: 4px;
        display: block;
    }
</style>
@endpush