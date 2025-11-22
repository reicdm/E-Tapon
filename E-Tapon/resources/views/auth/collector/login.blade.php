@extends('layouts.auth')
@section('title', 'Resident Login')
@section('content')
<div class="container border">
  <h1>COLLECTOR LOGIN</h1>
  <form method="POST" action="{{ route('resident.login.submit') }}">
    @csrf
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit" class="w-5 btn-orange-gradient text-lg shadow-xl">LOGIN</button>
  </form>
</div>
@endsection