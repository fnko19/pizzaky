@extends('layouts.app')

@section('content')
<div class="bg-gray-100">
    <div class="container mx-aut py-40 grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Informasi Pengguna -->
        <div class="pr-20">
            <h2 class="text-xl font-bold mb-4">Informasi Pengguna</h2>

            <div class="mb-4">
                <label class="block font-medium mb-1">Nama Pemesan</label>
                <input type="text" name="nama" class="w-full border shadow-sm rounded px-3 py-2" value="Silakan masukkan nama">
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Nomor Telepon</label>
                <input type="text" name="telepon" class="w-full border shadow-sm rounded px-3 py-2" value="Silakan masukkan nomor telepon">
            </div>

            <!-- Opsi Pengambilan -->
            <h2 class="text-xl font-bold mb-4 mt-6">Opsi Pengambilan</h2>

            <div class="mb-4">
                <label class="block font-medium mb-1">Opsi Pengambilan</label>
                <select name="pengambilan" class="w-full border shadow-sm rounded px-3 py-2">
                    <option>Antar ke rumah</option>
                    <option>Ambil di toko</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Alamat</label>
                <input type="text" name="alamat" class="w-full border shadow-sm rounded px-3 py-2" value="Silakan masukkan alamat">
            </div>

            <!-- Payment Method -->
            <h2 class="text-xl font-bold mb-4 mt-6">Payment Method</h2>

            <div>
                <label class="block font-medium mb-1">Opsi Pembayaran</label>
                <select name="metode_pembayaran" class="w-full border shadow-sm rounded px-3 py-2">
                    <option>Transfer</option>
                    <option>COD</option>
                </select>
            </div>
        </div>

        <!-- bagian order summary dengan tampilan seperti gambar -->
        <div class="bg-gray-50 p-12 rounded shadow">
            <h2 class="text-lg font-semibold mb-4">Order</h2>

            <div class="space-y-6">
                <!-- Item 1 -->
                <div class="grid grid-cols-[60px_1fr_1fr_1fr_1fr] gap-12 items-start">
                    <img src="/images/p1.png" class="w-14 h-14" alt="Tuna Melt">
                    <div>
                        <p class="font-semibold">Tuna Melt (M)</p>
                        <p class="text-sm text-gray-600">
                            Topping: keju<br>
                            Pinggiran: Sosis
                        </p>
                    </div>
                    <div>
                        <p class="font-semibold">Harga Satuan</p>
                        <p class="text-sm text-gray-600">
                            Rp 65.000
                        </p>
                    </div>
                    <div>
                        <p class="font-semibold">Jumlah</p>
                        <p class="text-sm text-gray-600">
                            1
                        </p>
                    </div>
                    <div>
                        <p class="font-semibold">Total Harga</p>
                        <p class="text-sm text-gray-600">
                            Rp 65.000
                        </p>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="grid grid-cols-[60px_1fr_1fr_1fr_1fr] gap-12 items-start">
                    <img src="/images/p2.jpg" class="w-14 h-14" alt="Beef Corn">
                    <div>
                        <p class="font-semibold">Beef Corn (M)</p>
                    </div>
                    <div>
                        <p class="font-semibold">Harga Satuan</p>
                        <p class="text-sm text-gray-600">
                            Rp 65.000
                        </p>
                    </div>
                    <div>
                        <p class="font-semibold">Jumlah</p>
                        <p class="text-sm text-gray-600">
                            2
                        </p>
                    </div>
                    <div>
                        <p class="font-semibold">Total Harga</p>
                        <p class="text-sm text-gray-600">
                            Rp 130.000
                        </p>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="flex justify-between text-sm">
                <span>Ongkir</span>
                <span class="font-semibold text-red-600">Rp 15.000</span>
            </div>
            <div class="flex justify-between text-sm">
                <span>Total</span>
                <span class="font-bold text-red-700">Rp 155.000</span>
            </div>

            <a href="{{ route('status_pesanan') }}" class="mt-6 w-full bg-red-700 hover:bg-red-800 text-white font-semibold py-2 rounded block text-center">
                Beli Sekarang
            </a>
        </div>
    </div>
</div>

@endsection
