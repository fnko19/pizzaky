@extends('layouts.app')

@section('content')
<div class="pt-8">
    <div class="flex w-full h-full bg-white shadow-lg rounded-lg overflow-hidden"> 
        <!-- Form Section -->
        <div class="flex justify-center items-center w-1/2">
            <div class="w-full max-w-md">
                <h2 class="text-2xl font-bold text-center mb-6">Kami Ingin Mendengar Pendapat Anda Tentang PizZaky🍕</h2>
                <p class="text-gray-600 text-center mb-6">Berikan kami umpan balik agar kami dapat terus meningkatkan layanan kami</p>

                <form action="{{ route('feedback.store') }}" method="POST" class="flex flex-col items-center">
                    @csrf
                    <div class="mb-4 w-full">
                            <label class="block font-semibold pb-2">Nama</label>
                            @auth
                                <input class="w-full px-3 py-2 shadow-md border rounded" type="text" name="nama_pengirim" value="{{ auth()->user()->name }}" readonly>
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            @else
                                <input class="w-full px-3 py-2 shadow-md border rounded" type="text" name="nama_pengirim" required>
                            @endauth
                    </div>
                    <div class="mb-4 w-full">
                        <label class="block font-semibold pb-2">Kategori</label>
                        <select name="kategori" class="w-full px-3 py-2 shadow-md border rounded" required>
                            <option value="Website">Website</option>
                            <option value="Makanan">Makanan</option>
                            <option value="Pelayanan">Pelayanan</option>
                        </select>
                    </div>
                    <div class="mb-4 w-full">
                        <label class="block font-semibold pb-2">Feedback</label>
                        <textarea name="isi" class="w-full px-3 py-2 shadow-md border rounded" placeholder="Silakan masukkan feedback" required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-red-700 text-white py-1 rounded">Kirim Feedback</button>

                    @if(session('success'))
                    <!-- Modal -->
                    <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                        <div class="bg-white rounded-lg shadow-lg p-6 w-80 text-center">
                            <h2 class="text-xl font-bold mb-2 text-black">Berhasil!</h2>
                            <p class="mb-4 text-gray-700">{{ session('success') }}</p>
                            <button onclick="document.getElementById('successModal').style.display='none'"
                                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>

        <!-- Image Section -->
        <div class="w-1/2 pt-8 h-screen">
            <img src="{{ asset('images/03.jpg') }}" alt="Pizza" class="h-full w-full object-cover">
        </div>
    </div>
</div>
@endsection

<script>
    // Tutup modal jika klik di luar kotak
    window.addEventListener('click', function(e) {
        const modal = document.getElementById('successModal');
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
</script>

