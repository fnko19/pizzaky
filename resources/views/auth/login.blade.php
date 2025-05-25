<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<script>
    function openModal() {
        document.getElementById('forgotPasswordModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('forgotPasswordModal').classList.add('hidden');
    }
</script>
<body class="h-screen flex items-center justify-center bg-gray-200">
    <div class="flex w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="w-1/2 px-14 py-20">
            <h2 class="text-2xl flex items-center justify-center font-bold mb-2">Selamat Datang</h2>
            <p class="text-gray-600 mb-6 flex items-center justify-center">Silakan masukkan data anda</p>

            {{-- Tampilkan pesan error jika login gagal --}}
            @if ($errors->any())
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        let errorMessages = `{!! implode('<br>', $errors->all()) !!}`;

                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            html: errorMessages,
                            confirmButtonColor: '#d33',
                        });
                    });
                </script>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block font-semibold">Email</label>
                    <input type="email" name="email" class="w-full p-3 border rounded" placeholder="Silakan masukkan email" required>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold">Password</label>
                    <input type="password" name="password" class="w-full p-3 border rounded" placeholder="Silakan masukkan password" required>
                </div>
                <div class="flex justify-end items-end mb-4">
                    <a href= {{ route('forgot-password') }} class="text-blue-600 text-sm">Lupa Password?</a>
                </div>
                <button type="submit" class="w-full bg-black text-white p-3 rounded font-semibold">
                    Login
                </button>
            </form>
            <p class="mt-4 text-sm flex items-center justify-center">Tidak memiliki akun? 
                <a href="{{ route('daftar') }}" class="text-blue-600 pl-1">Daftar sekarang</a>
            </p>
        </div>
        <div class="w-1/2">
            <img src="{{ asset('images/login.png') }}" alt="Login Image" class="h-full w-full object-cover">
        </div>
    </div>
</body>
</html>
