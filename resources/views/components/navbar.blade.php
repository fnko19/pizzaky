<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Responsive Navbar Transparan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[url('https://source.unsplash.com/1600x900/?pizza')] bg-cover bg-center min-h-screen">

  <nav class="fixed top-0 left-0 w-full z-50 bg-white/30 backdrop-blur-md shadow-md">
    <div class="container mx-auto flex justify-between items-center py-3">
      <h1 class="text-xl font-bold">PizZaky</h1>
      <ul class="flex space-x-8 items-center font-semibold mx-auto">
        <li>
          <a href="{{ route('home') }}" class="hover:text-red-400 {{ request()->routeIs('home') ? 'text-red-500' : '' }}">Beranda</a>
        </li>
        <li>
          <a href="{{ route('menu') }}" class="hover:text-red-400 {{ request()->routeIs('menu') ? 'text-red-500' : '' }}">Menu</a>
        </li>
        <li>
          <a href="{{ route('pemesanan') }}" class="hover:text-red-400 {{ request()->routeIs('pemesanan') ? 'text-red-500' : '' }}">Keranjang</a>
        </li>
        <li>
          <a href="{{ route('status_pesanan') }}" class="hover:text-red-400 {{ request()->routeIs('status_pesanan') ? 'text-red-500' : '' }}">Pesanan</a>
        </li>
        <li>
          <a href="{{ route('feedback') }}" class="hover:text-red-400 {{ request()->routeIs('feedback') ? 'text-red-500' : '' }}">Feedback</a>
        </li>
      </ul>
      <a href="{{ route('login') }}" class="inline-block bg-red-500 text-white px-3 py-1 rounded-sm font-bold">Login</a>
    </div>
  </nav>

</body>
</html>
