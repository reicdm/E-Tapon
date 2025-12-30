@extends('layouts.collector_success')

@section('title', 'Collector - Success')

@section('content')
<div class="overlay">
    <div class="popup-success">
        <div class="popup-box"></div>
        <h2 class="my-2">{{ $message ?? 'Request accepted!' }}</h2>

        <div class="action-buttons mt-3">
            <form action="{{ route('collector.success.confirm') }}" method="POST">
                @csrf
                <button type="submit" class="btn-ok">Confirm</button>
            </form>
        </div>
    </div>
</div>
@endsection