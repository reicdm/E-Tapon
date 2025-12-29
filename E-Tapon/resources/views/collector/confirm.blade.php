@extends('layouts.collector_confirm')

@section('title', 'Collector - Confirmation')

@section('content')
<div class="overlay">
    <div class="popup-confirm">
        <div class="circle-top"></div>
        <h2 class="my-2">{{ $confirmMessage ?? 'Are you sure you want to proceed?' }}</h2>

        <form action="{{ $confirmRoute ?? '#' }}" method="POST" class="action-buttons mt-4">
            @csrf

            {{-- Only include hidden inputs if they exist --}}
            @if(isset($hiddenInputs) && is_array($hiddenInputs))
            @foreach($hiddenInputs as $name => $value)
            <input type="hidden" name="{{ $name }}" value="{{ $value }}">
            @endforeach
            @endif

            <button type="submit" class="btn-confirm">Confirm</button>
            <a href="{{ $cancelRoute ?? route('collector.dashboard') }}" class="btn-cancel">Cancel</a>
        </form>
    </div>
</div>
@endsection