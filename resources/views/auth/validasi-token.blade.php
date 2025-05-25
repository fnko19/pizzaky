<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="h-screen flex items-center justify-center bg-gray-200">
    <div class="flex w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="w-1/2 px-14 py-16">
            <h2 class="text-2xl pt-12 flex items-center justify-center font-bold mb-2">Reset Password</h2>
            <p class="text-gray-600 mb-6 text-center">Silakan Masukkan Password Baru Anda</p>

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

            <form action="{{route('password.update')}}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="mb-4">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2 form-label">Password Baru</label>
                    <input type="password" name="password" placeholder="Masukkan Password Baru" class="w-full p-2 border-2 border-gray-500 rounded form-label" required>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2 mt-4 form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" placeholder="Masukkan Konfirmasi Password" class="w-full p-2 border-2 border-gray-500 rounded form-label" required>
                </div>

                <button type="submit"
                    class="w-full bg-black text-white py-2 rounded-md hover:bg-gray-700 transition duration-200 font-semibold">
                    Simpan Password
                </button>
            </form>
        </div>
        <div class="w-1/2">
            <img src="{{ asset('images/pizzaa.jpg') }}" alt="Pizza" class="h-full w-full object-cover">
        </div>
    </div>
</body>

</html>
