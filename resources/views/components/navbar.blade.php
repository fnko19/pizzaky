<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Responsive Navbar Transparan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[url('https://source.unsplash.com/1600x900/?pizza')] bg-cover bg-center min-h-screen">

  <!-- ✅ NAVBAR TRANSPARAN -->
  <nav class="fixed top-0 left-0 w-full z-50 bg-white/30 backdrop-blur-md shadow-md">
    <div class="container mx-auto flex justify-between items-center px-4 py-3">
      <h1 class="text-xl font-bold">PizZaky</h1>
      <ul class="flex space-x-8 items-center">
        <li><a href="{{ route('home') }}"  class=" hover:text-red-400">Beranda</a></li>
        <li><a href="{{ route('menu') }}"  class="hover:text-red-400">Menu</a></li>
        <li><a href="#"><img src="https://cdn-icons-png.flaticon.com/512/1170/1170576.png" alt="Cart" class="w-6"></a></li>
        <li><a href="#"><img src="https://cdn-icons-png.flaticon.com/512/1946/1946429.png" alt="Profile" class="w-8"></a></li>
      </ul>
    </div>
  </nav>
</body>
</html>
