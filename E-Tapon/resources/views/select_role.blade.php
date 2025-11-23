<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to E-Tapon</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://www.google.com/search?q=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
  <style>
    @import url('https://www.google.com/search?q=https://fonts.googleapis.com/css2%3Ffamily%3DRoboto:wght%40400%3B700%3B900%26display%3Dswap');

    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f7f7f7;
    }

    .resident-card {
      background: linear-gradient(135deg, #FF9100, #FFB24D);
    }

    .collector-card {
      background: linear-gradient(135deg, #1F4B2C, #4D7111);
    }

    .card-shadow {
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }
  </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">
  <div class="max-w-4xl w-full text-center">
    <h1 class="text-6xl font-black text-gray-800 mb-4">E-Tapon</h1>
    <p class="text-xl text-gray-600 mb-12">Select your role to proceed to the system.</p>

    <div class="flex flex-col md:flex-row gap-8">

      <!-- RESIDENT BUTTON -->
      <a href="{{ route('resident.login') }}" class="flex-1 transform transition duration-500 hover:scale-[1.03] resident-card card-shadow p-8 rounded-2xl text-white">
        <div class="flex flex-col items-center">
          <i class="fas fa-home text-6xl mb-4"></i>
          <h2 class="text-3xl font-bold mb-2">RESIDENT</h2>
          <p class="text-sm font-light opacity-80">Log in to schedule pickups, monitor pickups, and manage waste.</p>
        </div>
      </a>

      <!-- COLLECTOR BUTTON -->
      <a href="{{ route('collector.login') }}" class="flex-1 transform transition duration-500 hover:scale-[1.03] collector-card card-shadow p-8 rounded-2xl text-white">
        <div class="flex flex-col items-center">
          <i class="fas fa-truck text-6xl mb-4"></i>
          <h2 class="text-3xl font-bold mb-2">COLLECTOR</h2>
          <p class="text-sm font-light opacity-80">Access routes, view assigned pickups, and manage schedules.</p>
        </div>
      </a>

    </div>
  </div>


</body>

</html>