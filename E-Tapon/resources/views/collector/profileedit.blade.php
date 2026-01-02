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

                    <div class="card-field-edit">
                        <input id="name" type="text" class="form-control" placeholder="Phone Number">
                    </div>

                    <div class="card-field-edit">
                        <input id="name" type="text" class="form-control" placeholder="Email Address">
                    </div>

                    <div class="card-field-edit">
                        <input id="name" type="text" class="form-control" placeholder="Password">
                    </div>
                </div>
            </div>
        </div>

        <div class="action-buttons mt-4">
            <button class="btn-save" onclick="openSaveModal()">Save</button>
            <button class="btn-cancel" onclick="cancelEdit()">Cancel</button>
        </div>
    </div>
</div>
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

    function confirmSaveProfile() {
        document.getElementById('saveModal').style.display = 'none';
        document.getElementById('saveSuccessModal').style.display = 'flex';
    }

    function closeSuccessSaveModal() {
        document.getElementById('saveSuccessModal').style.display = 'none';
        window.location.href = "{{ route('collector.profile') }}";
    }
</script>
@endpush