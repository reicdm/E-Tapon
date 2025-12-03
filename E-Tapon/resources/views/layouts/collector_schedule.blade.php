<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'E-Tapon')</title>
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="{{ asset('css/collector_schedule.css') }}">

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

  <!--NEW-->
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>