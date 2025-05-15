<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Pastikan menggunakan SweetAlert -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen flex items-center justify-center bg-gray-200">
    <div class="flex w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="w-1/2 px-14 py-12">
            <h2 class="text-xl pt-20 flex items-center justify-center font-bold mb-4">Lupa Password</h2>

        <form action="{{ route('forgot-password-act') }}" method="post">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-center mb-8">Masukkan email yang terdaftar</label>
                <input type="email" name="email" required class="w-full p-3 border-2 rounded" placeholder="Masukkan email anda">
            </div>
            @error('email')
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: '{{ $message }}',
                        });
                    });
                </script>
            @enderror
            <div class="pt-1">
                <button type="submit" class="w-full bg-black text-white p-3 rounded font-semibold">
                    Kirim Link Reset Password
                </button>
            </div>    
        </form>
    </div>
    <div class="w-1/2">
            <img src="{{ asset('images/lupa.jpg') }}" alt="Login Image" class="h-full w-full object-cover">
        </div>
    @if ($message = Session::get('success'))
        <script>
            Swal.fire('{{ $message }}');
        </script>
    @endif

    @if ($message = Session::get('failed'))
        <script>
            Swal.fire('{{ $message }}');
        </script>
    @endif
</body>
<!-- Modal Error -->
<div id="errorModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white p-6 rounded shadow-lg w-80">
        <h2 class="text-xl text-center font-bold mb-4 text-red-600">Terjadi Kesalahan</h2>
        <p id="errorMessage" class="mb-6 text-center"></p>
        <button onclick="closeErrorModal()" class="w-full bg-black text-white py-2 rounded">Tutup</button>
    </div>
</div>
<script>
    @if ($message = Session::get('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ $message }}',
        });
    @endif

    @if ($message = Session::get('failed'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ $message }}',
        });
    </script>
    @endif
</script>

</html>
