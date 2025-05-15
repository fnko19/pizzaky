@extends('layouts.app')

@section('content')
<div class="py-32 bg-gray-100">
    <div class="container mx-auto bg-gray-50 p-10 rounded shadow">

        <h2 class="text-xl font-semibold text-red-600 mb-6">Pesanan Anda</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            <!-- Kolom Kiri: Info Pemesan -->
            <div>
                <p class="font-bold">Fani</p>
                <p class="text-sm text-gray-700 mb-2">Ramtek biru, Teknik Unhas, Bontomarannu, Gowa</p>

                <p class="font-bold">Metode Pembayaran</p>
                <p class="text-sm">Transfer</p>
                <!-- Upload Bukti Pembayaran -->
                <label class="block mt-2 mb-[1px] font-bold" for="bukti-pembayaran">
                    Upload Bukti Pembayaran 
                </label>
                <input type="file" id="bukti-pembayaran" name="bukti_pembayaran"
                    class="block w-[300px] text-sm text-gray-900 border border-gray-300 cursor-pointer bg-gray-50 focus:outline-none focus:ring focus:border-blue-300">
                    
                <p class="font-bold mt-2">Status Pembayaran</p>
                <p class="text-sm">Pembayaran anda telah dikonfirmasi admin</p>

                <p class="font-bold mt-2">Status Pesanan</p>
                <p class="text-sm text-gray-700 pb-2">Pesanan anda sedang disiapkan</p>
                <a href="https://wa.me/6285311389331" target="_blank" class="font-bold text-red-700 underline">
                Chat dengan Kurir
                </a>
            </div>

            <!-- Kolom Kanan: Detail Order -->
            <div class="space-y-6">
                <!-- Item 1 -->
                <div class="grid grid-cols-[60px_1fr_1fr_1fr_1fr] gap-8 items-start">
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
                        <p class="text-sm text-gray-600">Rp 65.000</p>
                    </div>
                    <div>
                        <p class="font-semibold">Jumlah</p>
                        <p class="text-sm text-gray-600">1</p>
                    </div>
                    <div>
                        <p class="font-semibold">Subtotal</p>
                        <p class="text-sm text-gray-600">Rp 65.000</p>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="grid grid-cols-[60px_1fr_1fr_1fr_1fr] gap-8 items-start">
                    <img src="/images/p2.jpg" class="w-14 h-14" alt="Beef Corn">
                    <div>
                        <p class="font-semibold">Beef Corn (M)</p>
                    </div>
                    <div>
                        <p class="font-semibold">Harga Satuan</p>
                        <p class="text-sm text-gray-600">Rp 65.000</p>
                    </div>
                    <div>
                        <p class="font-semibold">Jumlah</p>
                        <p class="text-sm text-gray-600">2</p>
                    </div>
                    <div>
                        <p class="font-semibold">Subtotal</p>
                        <p class="text-sm text-gray-600">Rp 130.000</p>
                    </div>
                </div>

                <!-- Total dan Ongkir -->
                <hr class="my-2">

                <div class="flex font-bold justify-between text-sm">
                    <span>Ongkir</span>
                    <span class="font-semibold text-red-600">Rp 15.000</span>
                </div>
                <div class="flex font-bold justify-between text-sm">
                    <span>Total</span>
                    <span class="font-bold text-red-700">Rp 210.000</span>
                </div>
            </div>
        </div>

        <!-- Tombol -->
        <div class="mt-6 space-y-4">
            <button class="w-full bg-red-700 hover:bg-red-800 text-white font-semibold py-2 rounded">
                Batalkan Pesanan
            </button>
            <button class="w-full bg-gray-400 text-white font-semibold py-2 rounded">
                Pesanan Diterima
            </button>
        </div>

    </div>
</div>
@endsection
