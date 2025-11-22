<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Tapon')</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col">
    <main class="flex-1">@yield('content')</main>
</body>

</html>