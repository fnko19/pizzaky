@extends('layouts.app')

@section('content')
<div class="bg-gray-100">
    <div class="container mx-aut py-40 grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Informasi Pengguna -->
        <div class="pr-20">
            <h2 class="text-xl font-bold mb-4">Informasi Pengguna</h2>

            <div class="mb-4">
                <label class="block font-medium mb-1">Nama Pemesan</label>
                @auth
                    <input class="w-full px-3 py-2 shadow-md border rounded" type="text" name="nama_pemesan" value="{{ auth()->user()->name }}" readonly>
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                @else
                    <input class="w-full px-3 py-2 shadow-md border rounded" type="text" name="nama_pemesan" required>
                @endauth
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Nomor Telepon</label>
                @auth
                    <input class="w-full px-3 py-2 shadow-md border rounded" type="text" name="nomor" value="{{ auth()->user()->no_telp }}" readonly>
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                @else
                    <input class="w-full px-3 py-2 shadow-md border rounded" type="text" name="nomor" required>
                @endauth
            </div>

            <!-- Opsi Pengambilan -->
            <div class="mb-4">
            <label class="block font-medium mb-1">Opsi Pengambilan</label>
            <select id="pengambilan" name="pengambilan" class="w-full border shadow-sm rounded px-3 py-2">
                <option value="antar">Antar ke rumah</option>
                <option value="toko">Ambil di toko</option>
            </select>
            </div>

            <div id="alamat-container" class="mb-4">
            <label class="block font-medium mb-1">Alamat</label>
                @auth
                    <input class="w-full px-3 py-2 shadow-md border rounded" type="text" name="alamat" value="{{ auth()->user()->alamat }}" readonly>
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                @else
                    <input class="w-full px-3 py-2 shadow-md border rounded" type="text" name="alamat" required>
                @endauth
            <script>
            const pengambilanSelect = document.getElementById('pengambilan');
            const alamatContainer = document.getElementById('alamat-container');

            function toggleAlamatField() {
                if (pengambilanSelect.value === 'antar') {
                alamatContainer.style.display = 'block';
                } else {
                alamatContainer.style.display = 'none';
                }
            }

            toggleAlamatField();

            pengambilanSelect.addEventListener('change', toggleAlamatField);
            </script>

            </div>
            <label class="block font-medium mb-1">Opsi Pembayaran</label>
            <form method="POST" action="{{ route('pemesanan.simpan') }}">
                @csrf
                <select name="metode_bayar" class="w-full border shadow-sm rounded px-3 py-2">
                    <option>Transfer</option>
                    <option>COD</option>
                </select>

                <button type="submit" class="mt-6 w-full bg-red-700 hover:bg-red-800 text-white font-semibold py-2 rounded">
                    Pesan Sekarang
                </button>
            </form>
        </div>

        <div class="bg-gray-50 p-12 rounded shadow">
    <h2 class="text-lg font-semibold mb-4">Order</h2>

    <div class="space-y-6">

        {{-- Detail Pizza --}}
        @foreach (optional($pesanan)->detailPesanan ?? [] as $item)
            <div class="grid grid-cols-[60px_1fr_1fr_1fr_1fr] gap-12 items-start">
                <img src="{{ Storage::url($item->pizza->image_path) }}" class="w-14 h-14" alt="{{ $item->pizza->nama }}">
                <div>
                    <p class="font-semibold">{{ $item->pizza->nama_pizza }} ({{ $item->pizza->ukuran }})</p>
                    <p class="text-sm text-gray-600">
                        Topping: {{ $item->ekstraTopping ?? '-' }}<br>
                        Pinggiran: {{ $item->ekstraPinggiran ?? '-' }}
                    </p>
                </div>
                <div>
                    <p class="font-semibold">Harga Satuan</p>
                    <p class="text-sm text-gray-600">
Rp {{ number_format(optional($pesanan)->ongkir ?? 0, 0, ',', '.') }}

                    </p>
                </div>
                <div>
                    <p class="font-semibold">Jumlah</p>
                    <p class="text-sm text-gray-600">
                        {{ $item->jumlah }}
                    </p>
                </div>
                <div>
                    <p class="font-semibold">Total Harga</p>
                    <p class="text-sm text-gray-600">
                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        @endforeach

        {{-- Detail Makanan Lain --}}
        @foreach ($pesanan->detailMakananLains as $item)
            <div class="grid grid-cols-[60px_1fr_1fr_1fr_1fr] gap-12 items-start">
                <img src="{{ Storage::url($item->makananLain->image_path) }}" class="w-14 h-14" alt="{{ $item->makananLain->nama }}">
                <div>
                    <p class="font-semibold">{{ $item->makananLain->nama_makanan }}</p>
                </div>
                <div>
                    <p class="font-semibold">Harga Satuan</p>
                    <p class="text-sm text-gray-600">
                        Rp {{ number_format($item->makananLain->harga, 0, ',', '.') }}
                    </p>
                </div>
                <div>
                    <p class="font-semibold">Jumlah</p>
                    <p class="text-sm text-gray-600">
                        {{ $item->jumlah }}
                    </p>
                </div>
                <div>
                    <p class="font-semibold">Total Harga</p>
                    <p class="text-sm text-gray-600">
                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        @endforeach

        {{-- Detail Pizza Panjang --}}
        @foreach ($pesanan->detailPizzaPanJangs as $item)
            <div class="grid grid-cols-[60px_1fr_1fr_1fr_1fr] gap-12 items-start">
                <img src="{{ Storage::url($item->pizzaPanjang->image_path) }}"  class="w-14 h-14" alt="{{ $item->pizzaPanjang->nama }}">
                <div>
                    <p class="font-semibold">{{ $item->pizzaPanjang->nama_pizza }}</p>
                </div>
                <div>
                    <p class="font-semibold">Harga Satuan</p>
                    <p class="text-sm text-gray-600">
                        Rp {{ number_format($item->pizzaPanjang->harga, 0, ',', '.') }}
                    </p>
                </div>
                <div>
                    <p class="font-semibold">Jumlah</p>
                    <p class="text-sm text-gray-600">
                        {{ $item->jumlah }}
                    </p>
                </div>
                <div>
                    <p class="font-semibold">Total Harga</p>
                    <p class="text-sm text-gray-600">
                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <hr class="my-4">

    <div class="flex justify-between text-sm">
        <span>Ongkir</span>
        <span class="font-semibold text-red-600">Rp {{ number_format($pesanan->ongkir, 0, ',', '.') }}</span>
    </div>
    <div class="flex justify-between text-sm">
        <span>Total</span>
        <span class="font-bold text-red-700">Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</span>
    </div>
</div>

    </div>
</div>

@endsection


