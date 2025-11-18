@extends('layouts.main')
@section('title', 'Resident Login')
@section('content')
<div class="container">
  <h1>RESIDENT LOGIN</h1>
  <form method="POST" action="{{ route('resident.login.submit') }}">
    @csrf
    <input type="email" name="email" placeholder="Email"><br><br>
    <input type="password" name="password" placeholder="Password"><br><br>
    <button type="submit">Login</button>
  </form>
</div>
@endsection