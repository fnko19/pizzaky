<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="h-screen flex items-center justify-center bg-gray-200">
    <div class="flex w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="w-1/2 px-14 py-16">
            <h2 class="text-2xl flex items-center justify-center font-bold mb-2">Selamat Datang</h2>
            <p class="text-gray-600 pb-5 flex items-center justify-center">Silakan masukkan data anda</p>
            <form action="{{ route('daftar.submit') }}" method="POST">
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
                <div class="mb-8">
                    <label class="block font-semibold">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full px-3 py-1.5 border rounded" placeholder="Silakan masukkan password lagi">
                </div>
                <button class="w-full bg-black text-white px-3 py-2 rounded">Daftar</button>
            </form>
            <p class="mt-4 text-sm flex items-center justify-center">Telah memiliki akun?  <a href="{{ route('login') }}" class="text-blue-600 pl-1"> Masuk sekarang</a></p>
        </div>
        <div class="w-1/2">
            <img src="{{ asset('images/pizza.jpg') }}" alt="Pizza" class="h-full w-full object-cover">
        </div>
        <!-- Modal Error -->
        @if ($errors->has('password'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Konfirmasi password tidak sesuai atau password kurang dari 6 karakter.',
                        confirmButtonColor: '#d33'
                    });
                });
            </script>
        @elseif ($errors->has('email'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Email telah digunakan. Silakan gunakan email lain.',
                        confirmButtonColor: '#d33'
                    });
                });
            </script>
        @elseif ($errors->has('name'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Nama wajib diisi.',
                        confirmButtonColor: '#d33'
                    });
                });
            </script>
        @endif
</body>
</html>