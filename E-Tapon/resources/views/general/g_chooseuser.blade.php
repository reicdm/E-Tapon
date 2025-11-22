@extends('layouts.g_user')

@section('title', 'Choose User')

@section('content')
<div class="parent-container min-h-screen flex flex-col">
    <div class="top-bar w-full relative"></div>

    <div class="bottom-card w-full flex-grow p-6">
        <div class="max-w-md mx-auto">

            <h1 class="text-4xl font-extrabold mb-10">
                Select User Type
            </h1>

            <form action="{{ route('chooseuser.resident.store') }}" method="POST">
                @csrf

                <input type="hidden" id="selectedUser" name="user_type">

                <div class="user-option card-user-resident mb-4" onclick="selectUser('resident', this)">
                    <img src="https://cdn-icons-png.flaticon.com/512/522/522297.png" class="user-img">

                    <div class="ml-4">
                        <h4 class="user-resident-text text-xl font-extrabold mb-2">Resident</h4>
                        <p class="card-text">Choose this if you are a household resident.</p>
                    </div>
                </div>

                <div class="user-option card-user-collector mb-4" onclick="selectUser('collector', this)">
                    <img src="https://cdn-icons-png.flaticon.com/512/522/522297.png" class="user-img">

                    <div class="ml-4">
                        <h2 class="user-collector-text text-xl font-extrabold mb-2">Collector</h2>
                        <p class="card-text">Choose this if you are a waste collector.</p>
                    </div>
                </div>

                <button type="submit" class="submit-btn">Next</button>
            </form>
        </div>
    </div>
</div>

<script>
function selectUser(type, element) {
    document.getElementById('selectedUser').value = type;

    document.querySelectorAll('.user-option').forEach(card => {
        card.classList.remove('active');
    });

    element.classList.add('active');
}
</script>

@endsection