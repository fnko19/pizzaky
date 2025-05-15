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
<div class="min-h-screen bg-gray-100 flex flex-col items-center pt-40 pb-20 space-y-6">

    {{-- Kartu Profil --}}
    <div class="bg-white rounded-xl shadow-md w-full max-w-5xl flex flex-col md:flex-row">
        <div class="md:w-1/2 relative">
            <img src="{{ asset('images/profile3.jpg') }}" alt="Profile Background" class="w-full h-64 object-cover rounded-t-xl md:rounded-l-xl md:rounded-tr-none">
            <div class="absolute top-36 pl-8 transform -translate-x-1/2 md:left-10 md:top-40">
                <img src="{{ Storage::url($user->foto) }}" alt="Avatar" class="w-20 h-20 rounded-full border-4 border-white object-cover">
            </div>
        </div>
        <div class="md:w-1/2 px-8 mt-16 md:mt-0 flex flex-col items-center space-y-2">
            <div class="w-full flex justify-end mt-4">
                <button onclick="toggleModal()" class="px-4 py-2 rounded-lg font-semibold hover:bg-red-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                    </svg>
                </button>
            </div>

            <h2 class="text-xl font-semibold">{{ $user->name }}</h2>
            <p><strong>Email :</strong> {{ $user->email }}</p>
            <p><strong>Nomor Telepon :</strong> {{ $user->no_telp }}</p>
            <p><strong>Alamat :</strong> {{ $user->alamat }}</p>
        </div>
    </div>

    {{-- Feedback Section --}}
    <div class="bg-white rounded-2xl shadow-md w-full max-w-5xl p-8">
        <h3 class="text-2xl font-bold mb-6 text-gray-800">Feedback</h3>

        @forelse ($feedbacks as $feedback)
            <div class="mb-6 p-6 bg-gray-50 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                <div class="flex items-start space-x-4">
                    <!-- Avatar -->
                    <div class="flex-shrink-0 w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-semibold text-sm">
                        {{ strtoupper(substr($feedback->user->name ?? 'U', 0, 1)) }}
                    </div>

                    <!-- Content -->
                    <div class="flex-1">
                        <p class="italic text-gray-700 text-sm mb-2">
                            <svg class="w-4 h-4 inline-block text-gray-400 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7.17 4.93C5.4 6.55 4 8.91 4 12h4c0-1.95.84-3.74 2.17-4.93A1 1 0 007.17 4.93zM17.17 4.93C15.4 6.55 14 8.91 14 12h4c0-1.95.84-3.74 2.17-4.93a1 1 0 00-1.41-1.41z"/>
                            </svg>
                            {{ $feedback->isi }}
                        </p>
                        <div class="flex justify-between text-xs text-gray-500">
                            <span>{{ $feedback->kategori }}</span>
                            <span>{{ $feedback->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500 italic">Belum ada feedback.</p>
        @endforelse
    </div>

    {{-- Modal Edit Profil --}}
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Edit Profil</h2>
            <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <label class="block">
                        <span class="font-semibold">Nama</span>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border px-3 py-2 rounded-md">
                    </label>
                    <label class="block">
                        <span class="font-semibold">Email</span>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border px-3 py-2 rounded-md">
                    </label>
                    <label class="block">
                        <span class="font-semibold">Nomor Telepon</span>
                        <input type="text" name="no_telp" value="{{ old('no_telp', $user->no_telp) }}" class="w-full border px-3 py-2 rounded-md">
                    </label>
                    <label class="block">
                        <span class="font-semibold">Alamat</span>
                        <input type="text" name="alamat" value="{{ old('alamat', $user->alamat) }}" class="w-full border px-3 py-2 rounded-md">
                    </label>

                    <!-- Tempat Foto -->
                    <label class="block">
                        <span class="font-semibold">Foto</span>
                        <input type="file" name="foto" accept="image/*" class="w-full border px-3 py-2 rounded-md">
                    </label>

                    <button type="submit" class="mt-4 px-4 py-1 bg-red-600 text-white rounded-md">Simpan</button>
                </div>
            </form>
                    </div>
    </div>

    {{-- Tombol Logout --}}
    <div class="py-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-red-600 text-white px-8 py-2 rounded-lg font-semibold hover:bg-red-700 transition">
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
