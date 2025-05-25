@php
    if ($pizza->nama_pizza == 'Pizza Classic Ukuran M') {
        $max_rasa = 2;
    } elseif ($pizza->nama_pizza == 'Pizza Classic Ukuran S') {
        $max_rasa = 1;
    }elseif ($pizza->nama_pizza == 'Pizza Classic Ukuran L') {
        $max_rasa = 2;
    }elseif ($pizza->nama_pizza == 'Pizza Setengah Meter') {
        $max_rasa = 4;
    } elseif ($pizza->nama_pizza == 'Pizza 1 Meter') {
        $max_rasa = 8;
    } else {
        $max_rasa = 1;
    }
@endphp

@extends('layouts.app')

@section('content')
<div class="flex min-h-screen items-start">
    <!-- Gambar Pizza -->
    <div class="w-[800px] bg-yellow-100 flex pb-20 pt-32 justify-center items-center  items-start sticky top-0 h-screen">
        <img src="{{ Storage::url($pizza->image_path) }}" 
             alt="Pizza" 
             class="w-[600px] h-[600px] object-cover border-40 border-white">
    </div>

    <!-- Detail Pizza dan Form -->
    <div class="w-1/2 px-20 py-40 flex flex-col">
        <!-- Header -->
        <h2 class="text-5xl font-bold mb-1">{{ $pizza->nama_pizza }}</h2>
        <p class="text-gray-400 text-lg mb-3">Rp {{ number_format($pizza->harga, 0, ',', '.') }}</p>
        <p class="mb-4 text-lg">{{ $pizza->deskripsi }}</p>

        <!-- FORM -->
        <form action="{{ route('pesanan.store') }}" method="POST" class="flex flex-col gap-4">
            @csrf
            <input type="hidden" name="pesanan_id" value="{{ $pesananAktif->id }}">
            <input type="hidden" name="pizza_id" value="{{ $pizza->id }}">

            <!-- Scrollable Area -->
            <div class="pr-2">
                <!-- Pilih Rasa -->
                <details class="text-lg mb-2">
                    <summary class="font-bold cursor-pointer flex justify-between items-center">
                        Pilih Rasa (Maksimal {{ $max_rasa }})
                        <img src="{{ asset('images/expand.png') }}" alt="Arrow" class="w-4 h-4">
                    </summary>
                    <div id="rasa-container" class="mt-3 grid grid-cols-1 gap-2 text-sm text-yellow-500 overflow-y-auto">
                        @foreach($rasaPizzas as $rasa)
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="rasa[]" value="{{ $rasa->id }}" class="rasa-checkbox">
                                <div>
                                    <strong class="text-lg">{{ $rasa->nama_rasa }}</strong><br>
                                    <span class="text-gray-400">{{ $rasa->deskripsi }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </details>

                <!-- Extra Topping -->
                <details class="text-lg mb-2">
                    <summary class="font-bold cursor-pointer flex justify-between items-center">
                        Extra Topping
                        <img src="{{ asset('images/expand.png') }}" alt="Arrow" class="w-4 h-4">
                    </summary>
                    <div class="mt-2 text-sm text-gray-700">
                        <label class="flex items-center gap-2 text-lg">
                            <input type="checkbox" name="extra_topping[]" value="Keju">
                            Keju <span class="text-gray-400 text-lg">+10k</span>
                        </label>
                    </div>
                </details>

                <!-- Extra Pinggiran -->
                <details class="text-lg mb-2">
                    <summary class="font-bold cursor-pointer flex justify-between items-center">
                        Extra Pinggiran
                        <img src="{{ asset('images/expand.png') }}" alt="Arrow" class="w-4 h-4">
                    </summary>
                    <div class="mt-2 text-sm text-gray-700">
                        <label class="inline-flex items-center space-x-2 mr-4">
                            <input type="checkbox" name="extra_pinggiran[]" value="Sosis">
                            <span class="text-lg">🌭 Sosis</span><span class="text-gray-400 text-lg">+10k</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="extra_pinggiran[]" value="Keju">
                            <span class="text-lg">🧀 Keju</span><span class="text-gray-400 text-lg">+15k</span>
                        </label>
                    </div>
                </details>
            </div>

            <!-- Jumlah -->
            <div>
                <label for="jumlah" class="block text-lg font-bold mb-2">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" min="1" value="1" class="w-20 p-2 border border-gray-300 rounded">
            </div>

            <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-6 rounded shadow self-start">
                Masukkan Keranjang
            </button>

        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const maxRasa = {{ $max_rasa }};
    const rasaCheckboxes = document.querySelectorAll('.rasa-checkbox');

    function updateLimit() {
        const checkedCount = Array.from(rasaCheckboxes).filter(cb => cb.checked).length;

        if (checkedCount >= maxRasa) {
            rasaCheckboxes.forEach(cb => {
                if (!cb.checked) {
                    cb.disabled = true;
                }
            });
        } else {
            rasaCheckboxes.forEach(cb => cb.disabled = false);
        }
    }

    rasaCheckboxes.forEach(cb => {
        cb.addEventListener('change', () => {
            updateLimit();
        });
    });

    updateLimit();
});
</script>

@endsection
