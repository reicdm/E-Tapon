@extends('layouts.collector_reqdetails')
@section('title', 'Collector Request')
@section('content')
<div class="overlay">
    <div class="popup">
        <div class="row justify-content-center">
            <div class="circle">

            </div>
            <h2 class="font-extrabold" style="color: var(--color-dark-green) ">Request Details</h2>
        </div>
        
        <div class="mb-4 form-input-group">
          <input id="email" type="email" name="email" placeholder="Email" required>
        </div>
    </div>
</div>
@endsection