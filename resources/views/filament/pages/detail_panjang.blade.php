@extends('layouts.app')

@section('content')
<div class="flex min-h-screen items-start">
    <!-- Gambar Pizza -->
    <div class="w-[800px] bg-yellow-100 flex pb-20 pt-32 justify-center items-center sticky top-0 h-screen">
        <img src="{{ Storage::url($pizzapanjang->image_path) }}" 
            alt="Pizza" 
            class="w-[600px] h-[600px] object-cover border-40 border-white">
    </div>

    <!-- Detail Pizza dan Form -->
    <div class="w-1/2 px-20 py-40 flex flex-col">
        <!-- Header -->
        <h2 class="text-5xl font-bold mb-1">{{ $pizzapanjang->nama_pizza }}</h2>
        <p class="text-gray-400 text-lg mb-3">Rp {{ number_format($pizzapanjang->harga, 0, ',', '.') }}</p>
        <p class="mb-4 text-lg">{{ $pizzapanjang->deskripsi }}</p>

        <form action="{{ route('panjang.store') }}" method="POST">
    @csrf
    <input type="hidden" name="pesanan_id" value="{{ $pesananAktif->id }}">
    <input type="hidden" name="pizza_panjang_id" value="{{ $pizzapanjang->id }}">

    <div>
        <label for="jumlah" class="block text-lg font-bold mb-2">Jumlah</label>
        <input type="number" name="jumlah" id="jumlah" min="1" value="1" class="w-20 p-2 border border-gray-300 rounded">
    </div>

    <div class="pt-4">
        <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-6 rounded shadow-md self-start">
            Masukkan Keranjang
        </button>
    </div>
</form>

    </div>
</div>
@endsection
