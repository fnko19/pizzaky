@extends('layouts.app')

@section('content')
<div class="pt-16">
    <div class="flex w-full h-full bg-white shadow-lg rounded-lg overflow-hidden"> 
        <!-- Form Section -->
        <div class="flex justify-center items-center w-1/2 py-20">
            <div class="w-full max-w-md">
                <h2 class="text-2xl font-bold text-center mb-6">Kami Ingin Mendengar Pendapat Anda Tentang PizZaky🍕</h2>
                <p class="text-gray-600 text-center mb-6">Berikan kami umpan balik agar kami dapat terus meningkatkan layanan kami</p>

                <form action="{{ route('feedback.store') }}" method="POST" class="flex flex-col items-center">
                    @csrf
                    <div class="mb-4 w-full">
                        <label class="block pb-2">Nama</label>
                        <input type="text" name="user_id" class="w-full p-3 shadow-md border rounded" placeholder="Silakan masukkan nama" required>
                    </div>
                    <div class="mb-4 w-full">
                        <label class="block pb-2">Kategori</label>
                        <select name="kategori" class="w-full p-3 shadow-md border rounded" required>
                            <option value="Website">Website</option>
                            <option value="Makanan">Makanan</option>
                            <option value="Pelayanan">Pelayanan</option>
                        </select>
                    </div>
                    <div class="mb-4 w-full">
                        <label class="block pb-2">Feedback</label>
                        <textarea name="isi" class="w-full p-3 shadow-md border rounded" placeholder="Silakan masukkan feedback" required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-red-700 text-white py-1 rounded">Kirim Feedback</button>
                    @if(session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

                </form>
            </div>
        </div>

        <!-- Image Section -->
        <div class="w-1/2">
            <img src="{{ asset('images/03.jpg') }}" alt="Pizza" class="h-full w-full object-cover">
        </div>
    </div>
</div>
@endsection
