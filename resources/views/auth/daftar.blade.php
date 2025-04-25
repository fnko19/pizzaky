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
            <p class="text-gray-600 pb-5 flex items-center justify-center">Silakan masukkan data anda</p>
            <form action="{{ route('daftar') }}" method="POST">
                @csrf
                <!-- Nama -->
                <div class="mb-4">
                    <label class="block font-semibold">Nama</label>
                    <input type="text" name="name" class="w-full px-3 py-1.5 border rounded" placeholder="Silakan masukkan nama">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block font-semibold">Email</label>
                    <input type="email" name="email" class="w-full px-3 py-1.5 border rounded" placeholder="Silakan masukkan email">
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label class="block font-semibold">Password</label>
                    <input type="password" name="password" class="w-full px-3 py-1.5 border rounded" placeholder="Silakan masukkan password">
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-4">
                    <label class="block font-semibold">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full px-3 py-1.5 border rounded" placeholder="Silakan masukkan password lagi">
                </div>
                <button class="w-full bg-black text-white px-3 py-2 rounded">Daftar</button>
            </form>
            <button class="w-full mt-3 flex items-center justify-center border px-3 py-2 rounded">
                    <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-5 h-5 mr-2"> Daftar dengan Google
                </button>
            <p class="mt-4 text-sm flex items-center justify-center">Telah memiliki akun?  <a href="{{ route('login') }}" class="text-blue-600 pl-1"> Masuk sekarang</a></p>
        </div>
        <div class="w-1/2">
            <img src="{{ asset('images/daftar.png') }}" alt="Pizza" class="h-full w-full object-cover">
        </div>
        <!-- Modal Error -->
        <div id="errorModal" <div id="errorModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full text-center">
                <h2 class="text-lg font-bold mb-4 text-red-600">Terjadi Kesalahan</h2>
                
                @if ($errors->has('password'))
                    <p class="text-black">Konfirmasi password tidak sesuai atau password kurang dari 6 karakter.</p>
                @elseif ($errors->has('email'))
                    <p class="text-black">Email telah digunakan. Silakan gunakan email lain.</p>
                @elseif ($errors->has('name'))
                    <p class="text-black">Nama wajib diisi.</p>
                @endif

                <div class="mt-4">
                    <button onclick="document.getElementById('errorModal').classList.add('hidden')" class="bg-black text-white px-4 py-2 rounded">Tutup</button>
                </div>
            </div>
        </div>
        @if ($errors->any())
        <script>
            window.onload = () => {
                document.getElementById('errorModal').classList.remove('hidden');
            };
        </script>
        @endif
    </div>
</body>
</html>