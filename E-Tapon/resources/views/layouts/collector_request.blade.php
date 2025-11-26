<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'E-Tapon')</title>
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('collector_request.css') }}">

  <script src="https://cdn.tailwindcss.com"></script>
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
</body>

</html>