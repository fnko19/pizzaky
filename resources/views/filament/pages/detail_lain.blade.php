@extends('layouts.app')

@section('content')
<div class="flex min-h-screen items-start">
    <!-- Gambar Makanan -->
    <div class="w-[800px] bg-yellow-100 flex pb-20 pt-32 justify-center items-center  items-start sticky top-0 h-screen">
        <img src="{{ Storage::url($makananlain->image_path) }}" 
            alt="makanan" 
            class="w-[600px] h-[600px] object-cover border-40 border-white">
    </div>

    <!-- Detail Makanan dan Form -->
    <div class="w-1/2 px-20 py-40 flex flex-col">
        <!-- Header -->
        <h2 class="text-5xl font-bold mb-1">{{ $makananlain->nama_makanan }}</h2>
        <p class="text-gray-400 text-lg mb-3">Rp {{ number_format($makananlain->harga, 0, ',', '.') }}</p>
        <p class="mb-4 text-lg">{{ $makananlain->deskripsi }}</p>

            <!-- Jumlah -->
            <div>
                <label for="jumlah" class="block text-lg font-bold mb-2">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" min="1" value="1" class="w-20 p-2 border border-gray-300 rounded">
            </div>

            <div class="pt-4">
                <a href="{{ route('pemesanan') }}" class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-6 rounded shadow-md self-start">
                    Masukkan Keranjang
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
