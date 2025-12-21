<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'E-Tapon')</title>
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <link rel="stylesheet" href="{{ asset('css/resident_dashboard.css') }}">

  @stack('styles')
</head>

<body class="flex flex-col @yield('body-class')">
  @include('layouts.resident_header')
  <main class="flex-1">@yield('content')</main>

  @stack('scripts')
</body>

</html>