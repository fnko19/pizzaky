<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<!-- Modal -->
<div id="forgotPasswordModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-md relative">
        <button onclick="closeModal()" class="absolute top-2 right-3 text-gray-500 hover:text-red-600 text-xl">&times;</button>
        <h3 class="text-xl font-bold mb-4">Reset Password</h3>

        @if (session('status'))
            <div class="mb-4 text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block font-semibold mb-1">Email</label>
                <input type="email" name="email" required class="w-full p-3 border rounded" placeholder="Masukkan email kamu">
            </div>
            <button type="submit" class="w-full bg-red-700 text-white p-3 rounded font-semibold">
                Kirim Link Reset
            </button>
        </form>
    </div>
</div>
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
                <div class="mb-4 text-red-500 text-sm text-center">
                    {{ $errors->first() }}
                </div>
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
                    <button type="button" onclick="openModal()" class="text-blue-600 text-sm">Lupa Password?</button>
                </div>
                <button type="submit" class="w-full bg-black text-white p-3 rounded font-semibold">
                    Login
                </button>
                <button type="button" class="w-full mt-3 flex items-center justify-center border p-3 rounded">
                    <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-5 h-5 mr-2"> Login dengan Google
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
