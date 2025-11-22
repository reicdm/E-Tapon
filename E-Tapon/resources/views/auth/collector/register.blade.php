@extends('layouts.auth')
@section('title', 'Register Collector')
@section('content')
<div class="container">
  <h1>REGISTER COLLECTOR</h1>
  <form method="POST" action="{{ route('collector.register.submit') }}">
    @csrf
    <input type="text" name="first_name" placeholder="First Name" required><br><br>
    <input type="text" name="middle_name" placeholder="Middle Name"><br><br>
    <input type="text" name="last_name" placeholder="Last Name" required><br><br>
    <input type="email" name="email" placeholder="Email"><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required><br><br>
    <button type="submit">Sign Up</button>
  </form>
</div>
@endsection