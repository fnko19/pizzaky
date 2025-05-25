<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Navbar PizZaky</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .navbar-solid {
      background-color: white;
    }
    .navbar-transparent {
      background-color: rgba(255, 255, 255, 0.3);
      backdrop-filter: blur(10px);
    }
  </style>
</head>
<body class="bg-[url('https://source.unsplash.com/1600x900/?pizza')] bg-cover bg-center min-h-screen">

  <nav id="navbar" class="fixed top-0 left-0 w-full z-50 navbar-solid shadow-md transition-all duration-300">
    <div class="container mx-auto flex justify-between items-center py-3 relative">

      <!-- Kiri: Logo/Brand -->
      <h1 class="text-xl font-bold">PizZaky</h1>

      <!-- Tengah: Menu -->
      <ul class="absolute left-1/2 transform -translate-x-1/2 flex space-x-8 items-center font-semibold">
        <li><a href="{{ route('home') }}" class="hover:text-red-400 {{ request()->routeIs('home') ? 'text-red-500' : '' }}">Beranda</a></li>
        <li><a href="{{ route('menu') }}" class="hover:text-red-400 {{ request()->routeIs('menu') ? 'text-red-500' : '' }}">Menu</a></li>
        <li><a href="{{ route('pemesanan.show') }}" class="hover:text-red-400 {{ request()->routeIs('pemesanan') ? 'text-red-500' : '' }}">Keranjang</a></li>
        <li><a href="{{ route('status_pesanan') }}" class="hover:text-red-400 {{ request()->routeIs('status_pesanan') ? 'text-red-500' : '' }}">Pesanan</a></li>
        <li><a href="{{ route('feedback') }}" class="hover:text-red-400 {{ request()->routeIs('feedback') ? 'text-red-500' : '' }}">Feedback</a></li>
      </ul>

      <!-- Kanan: Profil/Login -->
      <div class="flex items-center space-x-2">
        @auth
          @php
            $isProfileActive = request()->routeIs('profile');
            $profileImage = $isProfileActive
                ? asset('images/pr.png')   
                : asset('images/Name.png');        
          @endphp

          <div class="relative group">
            <a href="{{ route('profile') }}">
              <img src="{{ $profileImage }}" alt="Profile" class="w-9 h-9 cursor-pointer">
            </a>
          </div>
        @else
          <a href="{{ route('login') }}" class="bg-red-500 text-white px-3 py-1 rounded-sm font-bold">Login</a>
        @endauth
      </div>

    </div>
  </nav>

  <script>
    window.addEventListener('scroll', function () {
      const navbar = document.getElementById('navbar');
      if (window.scrollY > 10) {
        navbar.classList.remove('navbar-solid');
        navbar.classList.add('navbar-transparent');
      } else {
        navbar.classList.add('navbar-solid');
        navbar.classList.remove('navbar-transparent');
      }
    });
  </script>

</body>
</html>
