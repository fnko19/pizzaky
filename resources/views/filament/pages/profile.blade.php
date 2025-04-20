@extends('layouts.app')

<style>
  .scroll-clean {
    -ms-overflow-style: none;   
    scrollbar-width: none;     
  }

  .scroll-clean::-webkit-scrollbar {
    display: none;             
  }
</style>


@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col items-center py-40 space-y-6">
    {{-- Kartu Profil --}}
    <div class="bg-white rounded-xl shadow-md w-full max-w-5xl flex flex-col md:flex-row">
        <div class="md:w-1/2 relative">
            <img src="{{ asset('images/profile3.jpg') }}" alt="Profile Background" class="w-full h-64 object-cover rounded-t-xl md:rounded-l-xl md:rounded-tr-none">
            <div class="absolute top-48 pl-8 transform -translate-x-1/2 md:left-10 md:top-40">
                <img src="{{ asset('images/profile5.jpg') }}" alt="Avatar" class="w-20 h-20 rounded-full border-4 border-white object-cover">
            </div>
        </div>
        <div class="md:w-1/2 px-8 mt-16 md:mt-0 flex flex-col items-center space-y-2">
    
        <div class="w-full flex justify-end mt-4">
            <button onclick="toggleModal()" class=" px-4 py-2 rounded-lg font-semibold hover:bg-red-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
            </button>
        </div>

        <h2 class="text-xl font-semibold">Pani</h2>
        <p><strong>Email :</strong> panitipani@gmail.com</p>
        <p><strong>Nomor Telepon :</strong> 089799699599</p>
        <p><strong>Alamat :</strong> Borongloe, Kec. Bontomarannu, Gowa</p>
    </div>

    </div>

    {{-- Riwayat Pembelian --}}
    <div class="bg-white rounded-xl shadow-sm w-full max-w-5xl p-6">
        <h3 class="text-xl font-semibold my-4">Riwayat Pembelian</h3>
        <div class="flex space-x-4 pb-12 overflow-x-auto scroll-clean">
            @foreach ($riwayatPembelian as $item)
            <div class="bg-white border-4 border-gray-200 rounded-md w-60 flex-shrink-0">
                <div class="">
                    <img src="{{ $item['gambar'] }}" alt="Pizza" class="w-full object-cover">
                </div>
                <div class="p-4 ">
                    <p class="font-semibold">{{ $item['nama'] }}</p>
                    <p class="text-sm text-gray-500">Rasa: {{ $item['rasa'] }}</p>
                    <p class="text-sm text-gray-500">
                        Topping: {{ $item['topping'] ?? '-' }}
                    </p>
                    <p class="text-sm text-gray-500">Pinggiran: {{ $item['pinggiran'] ?? '-' }}</p>
                    <p class="text-sm mt-1 text-gray-500">{{ $item['tanggal'] }}</p>
                    <div class="mt-1 font-bold">Rp {{ number_format($item['harga'], 0, ',', '.') }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Modal Edit Profil -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-gray-200 rounded-lg p-12 w-full max-w-md space-y-4 shadow-xl">
            <h2 class="text-xl font-semibold flex justify-center">Edit Profil</h2>
            <form method="POST" action="{{ route('profil.update') }}">
                @csrf
                @method('PUT')
                <div class="space-y-2">
                    <label class="block">
                        <span class="font-semibold mb-4">Nama</span>
                        <input type="text" name="nama" value="{{ old('nama', 'Pani') }}" class="w-full border px-3 py-2 rounded-md">
                    </label>
                    <label class="block">
                        <span class="font-semibold mb-4">Email</span>
                        <input type="email" name="email" value="{{ old('email', 'panitipani@gmail.com') }}" class="w-full border px-3 py-2 rounded-md">
                    </label>
                    <label class="block">
                        <span class="font-semibold mb-4">Nomor Telepon</span>
                        <input type="text" name="telepon" value="{{ old('telepon', '089799699599') }}" class="w-full border px-3 py-2 rounded-md">
                    </label>
                    <label class="block">
                        <span class="font-semibold mb-4">Alamat</span>
                        <input type="text" name="alamat" value="{{ old('alamat', 'Borongloe, Kec. Bontomarannu, Gowa') }}" class="w-full border px-3 py-2 rounded-md">
                    </label>
                </div>
                <div class="flex justify-end space-x-2 mt-4"> 
                    <button type="button" onclick="toggleModal()" class="px-4 py-2 bg-white border hover:bg-gray-300 rounded-md">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md">Simpan</button>
                </div>
            </form>
        </div>
</div>


    {{-- Tombol Logout --}}
    <div class="py-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-red-600 text-white px-12 py-2 rounded-lg font-semibold hover:bg-red-700 transition">
                Log Out
            </button>
        </form>
    </div>
</div>

<script>
  function toggleModal() {
    const modal = document.getElementById('editModal');
    modal.classList.toggle('hidden');
  }
</script>

@endsection

