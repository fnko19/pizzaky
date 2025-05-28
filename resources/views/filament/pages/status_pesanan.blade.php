@extends('layouts.app')

@section('content')
<!-- Include the confirmation modals -->
@include('components.confirmation-modal')
@include('components.cancellation-modal')

<div class="py-32 bg-gray-100">
    <div class="container mx-auto bg-gray-50 p-10 rounded shadow">

        @if(session('success'))
            <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <h2 class="text-xl font-semibold text-red-600 mb-6">Pesanan Anda</h2>

        @if(!$hasOrder)
            <div class="text-center py-10">
                <p class="text-lg text-gray-600">Anda belum memiliki pesanan aktif.</p>
                <a href="{{ route('menu') }}" class="mt-4 inline-block bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded">
                    Pesan Sekarang
                </a>
            </div>
        @else
            <div class="space-y-8">
                @foreach($orders as $order)
                <div class="p-6 border border-gray-200 rounded-lg bg-white shadow-sm">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Pesanan #{{ $order->id }} 
                        <span class="text-sm font-normal text-gray-500 ml-2">{{ $order->created_at->format('d M Y, H:i') }}</span>
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                        <!-- Kolom Kiri: Info Pemesan -->
                        <div>
                            <p class="font-bold">{{ $user->name }}</p>
                            <p class="text-sm text-gray-700 mb-2">{{ $user->alamat }}</p>
                            
                            <p class="font-bold">Metode Pembayaran</p>
                            <p class="text-sm">{{ $order->pembayaran ? $order->pembayaran->metode_bayar : 'Belum dipilih' }}</p>
                            
                            @if($order->pembayaran && $order->pembayaran->metode_bayar === 'Transfer' 
                                    && (!$order->pembayaran->file_path || $order->pembayaran->status_bayar 
                                    !== 'Lunas') && $order->status_pesanan !== ('batal' || $order->status_pesanan 
                                    === 'Selesai' || $order->status_pesanan === 'Diterima'
                                ))
                                <!-- Upload Bukti Pembayaran -->
                                <form action="{{ route('payment.upload', $order->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label class="block mt-2 mb-[1px] font-bold" for="payment_proof_{{ $order->id }}">
                                        Upload Bukti Pembayaran 
                                    </label>
                                    <input type="file" id="payment_proof_{{ $order->id }}" name="payment_proof" required
                                        class="block w-[300px] text-sm text-gray-900 border border-gray-300 cursor-pointer bg-gray-50 focus:outline-none focus:ring focus:border-blue-300">
                                    @error('payment_proof')
                                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                    <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded text-sm">
                                        Upload
                                    </button>
                                </form>
                            @endif
                            
                            <!-- Display payment proof if exists -->
                            @if($order->pembayaran && $order->pembayaran->file_path)
                                <div class="mt-2">
                                    <p class="font-bold">Bukti Pembayaran</p>
                                    <img src="{{ asset($order->pembayaran->file_path) }}" alt="Bukti Pembayaran" class="mt-1 max-w-[150px] border">
                                </div>
                            @endif
                                
                            <p class="font-bold mt-2">Status Pembayaran</p>
                            @if($order->status_pesanan === 'batal')
                                <p class="text-sm text-red-600">Pesanan anda berhasil dibatalkan</p>
                            @elseif($order->status_pesanan === 'Selesai' || $order->status_pesanan === 'Diterima')
                                <p class="text-sm text-green-600">Pesanan ini sudah anda terima</p>
                            @elseif(!$order->pembayaran || $order->pembayaran->getStatusDisplay() === 'pending')
                                <p class="text-sm text-yellow-600">{{ $order->pembayaran ? $order->pembayaran->getStatusMessage() : 'Menunggu Pembayaran Dinotice Admin Nih 😊!' }}</p>
                            @else
                                <p class="text-sm text-green-600">Pembayaran anda telah dikonfirmasi admin</p>
                            @endif

                            <p class="font-bold mt-2">Status Pesanan</p>
                            <p class="text-sm text-gray-700 pb-2">{{ $order->getStatusMessage() }}</p>

                            @if($order->status_pesanan === 'Sedang Dikirim' && $order->whatsapp_driver)
                                <a href="https://wa.me/{{ $order->whatsapp_driver }}" target="_blank" class="font-bold text-red-700 underline">
                                Chat dengan Kurir
                                </a>
                            @endif
                        </div>

                        <!-- Kolom Kanan: Detail Order -->
                        <div class="space-y-6">
                            <!-- Pizza Items -->
                            @foreach($order->detailPesanan as $detail)
                                <div class="grid grid-cols-[60px_1fr_1fr_1fr_1fr] gap-8 items-start">
                                    <img src="{{ $detail->pizza->image_path ? asset('storage/' . $detail->pizza->image_path) : '/images/default-pizza.jpg' }}" class="w-14 h-14" alt="{{ $detail->pizza->nama_pizza }}">
                                    <div>
                                        <p class="font-semibold">{{ $detail->pizza->nama_pizza }} ({{ $detail->pizza->ukuran }})</p>
                                        <p class="text-sm text-gray-600">
                                            @if($detail->ekstraTopping)
                                                Topping: {{ $detail->ekstraTopping }}<br>
                                            @endif
                                            @if($detail->ekstraPinggiran)
                                                Pinggiran: {{ $detail->ekstraPinggiran }}
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Harga Satuan</p>
                                        <p class="text-sm text-gray-600">Rp {{ number_format($detail->pizza->harga, 0, ',', '.') }}</p>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Jumlah</p>
                                        <p class="text-sm text-gray-600">{{ $detail->jumlah }}</p>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Subtotal</p>
                                        <p class="text-sm text-gray-600">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Makanan Lain Items -->
                            @foreach($order->detailMakananLains as $detail)
                                <div class="grid grid-cols-[60px_1fr_1fr_1fr_1fr] gap-8 items-start">
                                    <img src="{{ $detail->makananLain->image_path ? asset('storage/' . $detail->makananLain->image_path) : '/images/default-food.jpg' }}" class="w-14 h-14" alt="{{ $detail->makananLain->nama_makanan }}">
                                    <div>
                                        <p class="font-semibold">{{ $detail->makananLain->nama_makanan }}</p>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Harga Satuan</p>
                                        <p class="text-sm text-gray-600">Rp {{ number_format($detail->makananLain->harga, 0, ',', '.') }}</p>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Jumlah</p>
                                        <p class="text-sm text-gray-600">{{ $detail->jumlah }}</p>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Subtotal</p>
                                        <p class="text-sm text-gray-600">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Pizza Panjang Items -->
                            @foreach($order->detailPizzaPanjangs as $detail)
                                <div class="grid grid-cols-[60px_1fr_1fr_1fr_1fr] gap-8 items-start">
                                    <img src="{{ $detail->pizzaPanjang->image_path ? asset('storage/' . $detail->pizzaPanjang->image_path) : '/images/default-pizza.jpg' }}" class="w-14 h-14" alt="{{ $detail->pizzaPanjang->nama_pizza }}">
                                    <div>
                                        <p class="font-semibold">{{ $detail->pizzaPanjang->nama_pizza }}</p>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Harga Satuan</p>
                                        <p class="text-sm text-gray-600">Rp {{ number_format($detail->pizzaPanjang->harga, 0, ',', '.') }}</p>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Jumlah</p>
                                        <p class="text-sm text-gray-600">{{ $detail->jumlah }}</p>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Subtotal</p>
                                        <p class="text-sm text-gray-600">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Total dan Ongkir -->
                            <hr class="my-2">

                            <div class="flex font-bold justify-between text-sm">
                                <span>Ongkir</span>
                                <span class="font-semibold text-red-600">Rp {{ number_format($order->ongkir, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex font-bold justify-between text-sm">
                                <span>Total</span>
                                <span class="font-bold text-red-700">Rp {{ number_format($order->total_bayar, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="mt-6 space-y-4">
                        <div class="flex space-x-4">
                            @if((!$order->pembayaran || $order->pembayaran->getStatusDisplay() !== 'terkonfirmasi') && $order->status_pesanan !== 'batal' && $order->status_pesanan !== 'Selesai' && $order->status_pesanan !== 'Diterima')
                                <button type="button" onclick="openCancellationModal('{{ $order->id }}')" class="w-full bg-red-700 hover:bg-red-800 text-white font-semibold py-2 rounded">
                                    Batalkan Pesanan
                                </button>
                            @endif
                            
                            @if($order->status_pesanan === 'Sedang Dikirim')
                                <button type="button" onclick="openConfirmationModal('{{ $order->id }}')" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded">
                                    Pesanan Diterima
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Pagination Links -->
                <div class="mt-6 py-4">
                    {{ $orders->links() }}
                </div>
            </div>
        @endif

    </div>
</div>

<!-- JavaScript for modals is included in the component files -->
<script>
    // Routes for modals
    function openConfirmationModal(orderId) {
        // Set the form action dynamically
        document.getElementById('confirmReceiptForm').action = "{{ route('order.confirm', ':id') }}".replace(':id', orderId);
        // Show the modal
        document.getElementById('confirmationModal').classList.remove('hidden');
        console.log('Opening confirmation modal for order ID:', orderId);
    }
    
    function closeConfirmationModal() {
        document.getElementById('confirmationModal').classList.add('hidden');
        console.log('Closing confirmation modal');
    }
    
    function openCancellationModal(orderId) {
        // Set the form action dynamically
        document.getElementById('cancelOrderForm').action = "{{ route('order.cancel', ':id') }}".replace(':id', orderId);
        // Show the modal
        document.getElementById('cancellationModal').classList.remove('hidden');
        console.log('Opening cancellation modal for order ID:', orderId);
    }
    
    function closeCancellationModal() {
        document.getElementById('cancellationModal').classList.add('hidden');
        console.log('Closing cancellation modal');
    }
    
    // Generic close function that can be used by either modal
    function closeModal() {
        document.getElementById('confirmationModal').classList.add('hidden');
        document.getElementById('cancellationModal').classList.add('hidden');
        console.log('Closing all modals');
    }
</script>
@endsection
