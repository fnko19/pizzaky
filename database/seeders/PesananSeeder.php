<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\pesanan;
use App\Models\pembayaran;
use App\Models\pizza;
use App\Models\detailPesanan;
use App\Models\makananLain;
use App\Models\detailMakananLain;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, ensure we have a test user
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'alamat' => 'Jl. Test Alamat No. 123, Makassar'
            ]
        );

        // Create different orders for testing different statuses
        
        // 1. Order statuses
        $this->createOrderInProcess($user);                 // Sedang di Proses
        $this->createOrderInDelivery($user);                // Sedang Dikirim
        $this->createOrderReadyForPickup($user);            // Siap Diambil
        $this->createOrderCompleted($user);                 // Selesai
        $this->createOrderCancelled($user);                 // batal
        
        // 2. Payment statuses
        $this->createOrderPendingPayment($user);            // Menunggu Dikonfirmasi
        $this->createOrderUnpaid($user);                    // Belum di Bayar
        $this->createOrderPaid($user);                      // Lunas
    }

    private function createOrderInProcess($user)
    {
        // Create a pesanan in "being prepared" status
        $order = pesanan::create([
            'user_id' => $user->id,
            'total_harga' => 65000,
            'status_pesanan' => 'Sedang di Proses', // maps to 'disiapkan' in PRD
            'opsi_pengambilan' => 'Antar ke Rumah',
            'ongkir' => 15000,
            'total_bayar' => 80000,
        ]);

        // Add a pizza to the order
        $pizza = pizza::first();
        if ($pizza) {
            detailPesanan::create([
                'pesanan_id' => $order->id,
                'pizza_id' => $pizza->id,
                'jumlah' => 1,
                'subtotal' => 65000,
            ]);
        }

        // Create payment record with pending status
        pembayaran::create([
            'pesanan_id' => $order->id,
            'metode_bayar' => 'Transfer',
            'status_bayar' => 'Belum di Bayar', // maps to 'pending' in PRD
        ]);
    }

    private function createOrderInDelivery($user)
    {
        // Create a pesanan in "in delivery" status
        $order = pesanan::create([
            'user_id' => $user->id,
            'total_harga' => 130000,
            'status_pesanan' => 'Sedang Dikirim', // maps to 'dikirim' in PRD
            'opsi_pengambilan' => 'Antar ke Rumah',
            'whatsapp_driver' => '6281234567890',
            'ongkir' => 15000,
            'total_bayar' => 145000,
        ]);

        // Add a pizza to the order
        $pizza = pizza::first();
        if ($pizza) {
            detailPesanan::create([
                'pesanan_id' => $order->id,
                'pizza_id' => $pizza->id,
                'jumlah' => 2,
                'subtotal' => 130000,
            ]);
        }

        // Create payment record with confirmed status
        pembayaran::create([
            'pesanan_id' => $order->id,
            'metode_bayar' => 'Transfer',
            'status_bayar' => 'Lunas', // maps to 'terkonfirmasi' in PRD
            'file_path' => 'storage/payment_proofs/sample_payment.jpg',
        ]);
    }

    private function createOrderReadyForPickup($user)
    {
        // Create a pesanan in "siap diambil" status
        $order = pesanan::create([
            'user_id' => $user->id,
            'total_harga' => 85000,
            'status_pesanan' => 'Siap Diambil', // maps to 'siap_diambil' in PRD
            'opsi_pengambilan' => 'Ambil di Toko',
            'ongkir' => 0, // No delivery fee for pickup
            'total_bayar' => 85000,
        ]);

        // Add a pizza to the order
        $pizza = pizza::first();
        if ($pizza) {
            detailPesanan::create([
                'pesanan_id' => $order->id,
                'pizza_id' => $pizza->id,
                'jumlah' => 1,
                'subtotal' => 65000,
            ]);
        }

        // Add a makanan lain to the order
        $makananLain = makananLain::first();
        if ($makananLain) {
            detailMakananLain::create([
                'pesanan_id' => $order->id,
                'makanan_lain_id' => $makananLain->id,
                'jumlah' => 1,
                'subtotal' => 20000,
            ]);
        }

        // Create payment record with confirmed status
        pembayaran::create([
            'pesanan_id' => $order->id,
            'metode_bayar' => 'Transfer',
            'status_bayar' => 'Lunas', // maps to 'terkonfirmasi' in PRD
            'file_path' => 'storage/payment_proofs/sample_payment.jpg',
        ]);
    }

    private function createOrderCancelled($user)
    {
        // Create a pesanan that is cancelled
        $order = pesanan::create([
            'user_id' => $user->id,
            'total_harga' => 65000,
            'status_pesanan' => 'batal', // Using 'batal' status directly
            'opsi_pengambilan' => 'Antar ke Rumah',
            'ongkir' => 15000,
            'total_bayar' => 80000,
        ]);

        // Add a pizza to the order
        $pizza = pizza::first();
        if ($pizza) {
            detailPesanan::create([
                'pesanan_id' => $order->id,
                'pizza_id' => $pizza->id,
                'jumlah' => 1,
                'subtotal' => 65000,
            ]);
        }

        // Create payment record with pending status
        pembayaran::create([
            'pesanan_id' => $order->id,
            'metode_bayar' => 'Transfer',
            'status_bayar' => 'Belum di Bayar', // maps to 'pending' in PRD
        ]);
    }

    private function createOrderCompleted($user)
    {
        // Create a pesanan in "completed" status
        $order = pesanan::create([
            'user_id' => $user->id,
            'total_harga' => 65000,
            'status_pesanan' => 'Selesai', // Completed order
            'opsi_pengambilan' => 'Antar ke Rumah',
            'ongkir' => 15000,
            'total_bayar' => 80000,
        ]);

        // Add a pizza to the order
        $pizza = pizza::first();
        if ($pizza) {
            detailPesanan::create([
                'pesanan_id' => $order->id,
                'pizza_id' => $pizza->id,
                'jumlah' => 1,
                'subtotal' => 65000,
            ]);
        }

        // Create payment record with confirmed status
        pembayaran::create([
            'pesanan_id' => $order->id,
            'metode_bayar' => 'Transfer',
            'status_bayar' => 'Lunas', // maps to 'terkonfirmasi' in PRD
            'file_path' => 'storage/payment_proofs/sample_payment.jpg',
        ]);
    }

    private function createOrderPendingPayment($user)
    {
        // Create a pesanan with pending payment
        $order = pesanan::create([
            'user_id' => $user->id,
            'total_harga' => 65000,
            'status_pesanan' => 'Sedang di Proses',
            'opsi_pengambilan' => 'Antar ke Rumah',
            'ongkir' => 15000,
            'total_bayar' => 80000,
        ]);

        // Add a pizza to the order
        $pizza = pizza::first();
        if ($pizza) {
            detailPesanan::create([
                'pesanan_id' => $order->id,
                'pizza_id' => $pizza->id,
                'jumlah' => 1,
                'subtotal' => 65000,
            ]);
        }

        // Create payment record with pending status
        pembayaran::create([
            'pesanan_id' => $order->id,
            'metode_bayar' => 'Transfer',
            'status_bayar' => 'Menunggu Dikonfirmasi', // maps to 'pending' in PRD
            'file_path' => 'storage/payment_proofs/sample_pending_payment.jpg',
        ]);
    }

    private function createOrderUnpaid($user)
    {
        // Create a pesanan that is unpaid
        $order = pesanan::create([
            'user_id' => $user->id,
            'total_harga' => 65000,
            'status_pesanan' => 'Sedang di Proses',
            'opsi_pengambilan' => 'Antar ke Rumah',
            'ongkir' => 15000,
            'total_bayar' => 80000,
        ]);

        // Add a pizza to the order
        $pizza = pizza::first();
        if ($pizza) {
            detailPesanan::create([
                'pesanan_id' => $order->id,
                'pizza_id' => $pizza->id,
                'jumlah' => 1,
                'subtotal' => 65000,
            ]);
        }

        // Create payment record showing unpaid status
        pembayaran::create([
            'pesanan_id' => $order->id,
            'metode_bayar' => 'Transfer',
            'status_bayar' => 'Belum di Bayar',
        ]);
    }

    private function createOrderPaid($user)
    {
        // Create a pesanan that is paid
        $order = pesanan::create([
            'user_id' => $user->id,
            'total_harga' => 65000,
            'status_pesanan' => 'Sedang di Proses',
            'opsi_pengambilan' => 'Antar ke Rumah',
            'ongkir' => 15000,
            'total_bayar' => 80000,
        ]);

        // Add a pizza to the order
        $pizza = pizza::first();
        if ($pizza) {
            detailPesanan::create([
                'pesanan_id' => $order->id,
                'pizza_id' => $pizza->id,
                'jumlah' => 1,
                'subtotal' => 65000,
            ]);
        }

        // Create payment record with paid status
        pembayaran::create([
            'pesanan_id' => $order->id,
            'metode_bayar' => 'Transfer',
            'status_bayar' => 'Lunas', // maps to 'terkonfirmasi' in PRD
            'file_path' => 'storage/payment_proofs/sample_paid.jpg',
        ]);
    }
}
