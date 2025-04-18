@extends('layouts.app')

@section('content')
<div class="flex h-screen">

    @php
        $rasaList = [
            "Meat Lovers" => "Pizza dengan saus tomat, aneka macam sosis, daging sapi giling, beef burger dan mozarella",
            "Deluxe Cheese" => "Pizza dengan saus tomat dan mozzarella melimpah",
            "Beef Mushroom" => "Pizza dengan saus tomat, aneka macam sosis, daging sapi giling, beef burger dan mozarella",
            "BBQ Chicken Mushroom" => "Pizza dengan mozzarella, jamur, ayam, sosis, dan saus BBQ",
            "Beef Corn" => "Pizza dengan saus tomat, keju mozzarella, beef burger, dan jagung manis",
            "Tuna Melt" => "Pizza dengan saus tuna, jagung manis, dan mozzarella",
            "Pepperoni Cheese" => "Pizza dengan saus tomat, keju mozzarella, dan pepperoni",
            "Pizza Supreme" => "Pizza dengan saus tomat, keju mozzarella, pepperoni, smoked beef, daging sapi giling, beef burger, paprika, bombay dan mozzarella",
            "Blackpepper Beef" => "Pizza dengan saus blackpepper, keju mozzarella, daging sapi, bawang bombai, dan paprika"
        ];
    @endphp

    <div class="w-1/2">
        <img src="{{ asset('images/detail.png') }}" alt="Pizza" class="w-full h-full object-cover">
    </div>

    <div class="w-1/2 px-12 py-40 overflow-y-auto">
        <h2 class="text-5xl font-bold mb-1">Pizza Ukuran M</h2>
        <p class="text-gray-400 text-lg mb-3">Rp 45.000</p>
        <p class="mb-4 text-lg">Pizza ukuran 22 cm dengan pilihan rasa yang bisa kamu kombinasikan, satu atau dua rasa sekaligus</p>

        {{-- Pilih Rasa --}}
        <details class="mb-6 text-lg">
            <summary class="font-bold cursor-pointer flex justify-between items-center">
                Pilih Rasa 
                <img src="{{ asset('images/expand.png') }}" alt="Arrow" class="w-4 h-4 transition-transform duration-300">
            </summary>
            <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-3 text-sm text-gray-700">
                @foreach($rasaList as $rasa => $deskripsi)
                    <label class="flex items-start gap-2 bg-gray-100 p-3 rounded-xl shadow-sm hover:bg-gray-200 transition">
                        <input type="checkbox" class="mt-1 rasa-checkbox name="rasa[]" value="{{ $rasa }}" ">
                        <div>
                            <strong class="text-lg">{{ $rasa }}</strong><br>
                            <span class="text-gray-600">{{ $deskripsi }}</span>
                        </div>
                    </label>
                @endforeach
            </div>
        </details>

        {{-- Extra Topping --}}
        <details class="mb-4 text-lg">
            <summary class="font-bold cursor-pointer flex justify-between items-center">
                Extra Topping
                <img src="{{ asset('images/expand.png') }}" alt="Arrow" class="w-4 h-4 transition-transform duration-300">
            </summary>
            <div class="mt-2 text-sm text-gray-700">
                <label class="flex items-center gap-2 text-lg">
                    <input type="checkbox" name="extra_topping[]" value="Keju">
                    Keju<p class="text-gray-400 text-lg">+10k</p>
                </label>
            </div>
        </details>

        {{-- Extra Pinggiran --}}
        <details class="mb-4 text-lg">
            <summary class="font-bold text-lg cursor-pointer flex justify-between items-center">
                Extra Pinggiran
                <img src="{{ asset('images/expand.png') }}" alt="Arrow" class="w-4 h-4 transition-transform duration-300">
            </summary>
            <div class="mt-2 text-sm text-gray-700">
                <label class="inline-flex items-center space-x-2 mr-4">
                    <input type="checkbox" name="extra_pinggiran[]" value="Sosis" class="form-checkbox text-lg text-red-500">
                    <span class="text-lg">🌭 Sosis</span><p class="text-gray-400 text-lg">+10k</p>
                </label>
                <label class="inline-flex items-center space-x-2">
                    <input type="checkbox" name="extra_pinggiran[]" value="Keju" class="form-checkbox text-lg text-yellow-500">
                    <span class="text-lg">🧀 Keju</span><p class="text-gray-400 text-lg">+15k</p>
                </label>
            </div>
        </details>

        <button class="bg-yellow-400 text-lg hover:bg-yellow-500 text-white font-bold py-2 px-6 rounded shadow">
            Masukkan Keranjang
        </button>
    </div>
</div>

<script>
    // Batasi pilihan rasa maksimal 2
    document.querySelectorAll('.rasa-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checked = document.querySelectorAll('.rasa-checkbox:checked');
            if (checked.length > 2) {
                alert("Maksimal dua rasa!");
                this.checked = false;
            }
        });
    });
</script>
@endsection
