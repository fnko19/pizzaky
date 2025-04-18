<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-gray-200">
    <div class="flex w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="w-1/2 px-14 py-20">
            <h2 class="text-2xl flex items-center justify-center font-bold mb-2">Selamat Datang</h2>
            <p class="text-gray-600 mb-6 flex items-center justify-center">Silakan masukkan data anda</p>
            <form action="#" method="POST">
                <div class="mb-4">
                    <label class="block">Email</label>
                    <input type="email" class="w-full p-3 border rounded" placeholder="Silakan masukkan email">
                </div>
                <div class="mb-4">
                    <label class="block">Password</label>
                    <input type="password" class="w-full p-3 border rounded" placeholder="Silakan masukkan password">
                </div>
                <div class="flex justify-end items-end mb-4">
                    <a href="#" class="text-blue-600 text-sm">Lupa Password</a>
                </div>
                <button class="w-full bg-black text-white p-3 rounded">Login</button>
                <button class="w-full mt-3 flex items-center justify-center border p-3 rounded">
                    <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-5 h-5 mr-2"> Login dengan Google
                </button>
            </form>
            <p class="mt-4 text-sm flex items-center justify-center">Tidak memiliki akun?  <a href="{{ route('daftar') }}" class="text-blue-600 pl-1""> Daftar sekarang</a></p>
        </div>
        <div class="w-1/2">
            <img src="{{ asset('images/login.png') }}" alt="Pizza" class="h-full w-full object-cover">
        </div>
    </div>
</body>
</html>