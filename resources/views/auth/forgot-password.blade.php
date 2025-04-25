<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="max-w-md mx-auto mt-40 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Lupa Password</h2>

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

        <button type="submit" class="w-full bg-black text-white p-3 rounded font-semibold">
            Kirim Link Reset Password
        </button>
    </form>
</body>
</html>
