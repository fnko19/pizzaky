<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-gray-200">
    <div class="flex w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="w-1/2 px-14 py-16">
            <h2 class="text-2xl flex items-center justify-center font-bold mb-2">Selamat Datang</h2>
            <p class="text-gray-600 mb-6 flex items-center justify-center">Silakan masukkan data anda</p>
            <form action="#" method="POST">
                <div class="mb-4">
                    <label class="block">Nama</label>
                    <input type="name" class="w-full px-3 py-1.5 border rounded" placeholder="Silakan masukkan nama">
                </div>
                <div class="mb-4">
                    <label class="block">Email</label>
                    <input type="email" class="w-full px-3 py-1.5 border rounded" placeholder="Silakan masukkan email">
                </div>
                <div class="mb-4">
                    <label class="block">Password</label>
                    <input type="password" class="w-full px-3 py-1.5 border rounded" placeholder="Silakan masukkan password">
                </div>
                <div class="mb-4">
                    <label class="block">Konfirmasi Password</label>
                    <input type="confirm_password" class="w-full px-3 py-1.5 border rounded" placeholder="Silakan masukkan password anda lagi">
                </div>
                <div class="flex justify-end items-end mb-4">
                    <a href="#" class="text-blue-600 text-sm">Lupa Password</a>
                </div>
                <button class="w-full bg-black text-white px-3 py-2 rounded">Daftar</button>
                <button class="w-full mt-3 flex items-center justify-center border px-3 py-2 rounded">
                    <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-5 h-5 mr-2"> Daftar dengan Google
                </button>
            </form>
            <p class="mt-4 text-sm flex items-center justify-center">Telah memiliki akun?  <a href="{{ route('login') }}" class="text-blue-600 pl-1"> Masuk sekarang</a></p>
        </div>
        <div class="w-1/2">
            <img src="{{ asset('images/daftar.png') }}" alt="Pizza" class="h-full w-full object-cover">
        </div>
    </div>
</body>
</html>