@extends('layouts.collector_success')

@section('title', 'Collector - Success')

@section('content')
<div class="overlay">
    <div class="popup-success">
        <div class="popup-box"></div>
        <h2 class="text-4xl font-extrabold my-2">Success!</h2>

        <div class="action-buttons mt-3">
            <button class="btn-ok">Confirm</button>
        </div>
    </div>
</div>

@endsection