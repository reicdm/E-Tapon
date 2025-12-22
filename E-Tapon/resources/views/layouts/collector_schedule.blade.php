<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'E-Tapon')</title>

  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <link rel="stylesheet" href="{{ asset('css/collector_schedule.css') }}">

  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>

  @stack('styles')

  <style>
    body {
      font-family: 'Roboto', sans-serif;
      min-height: 100vh;
      margin: 0;
    }
  </style>
</head>

<body class="min-h-screen flex flex-col">
  <main class="flex-1">
    @include('layouts.header')
    @yield('content')
  </main>
  @stack('scripts')
</body>

</html>