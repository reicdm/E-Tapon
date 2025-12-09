<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'E-Tapon')</title>
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <link rel="stylesheet" href="{{ asset('css/resident_dashboard.css') }}">
</head>

<body class="min-h-screen flex flex-col">
  @include('layouts.resident_header')
  <main class="flex-1">@yield('content')</main>
</body>

</html>