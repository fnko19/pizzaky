<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Replace the status_pesanan enum to include 'batal'
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn('status_pesanan');
        });

        Schema::table('pesanans', function (Blueprint $table) {
            $table->enum('status_pesanan', ['Diterima','Sedang di Proses','Siap Diambil', 'Sedang Dikirim', 'Selesai', 'batal'])
                ->after('total_harga');
        });

        // If there are any orders with 'note' == 'cancelled', update them to status 'batal'
        DB::statement("UPDATE pesanans SET status_pesanan = 'batal' WHERE note = 'cancelled'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // First, make sure we don't lose any 'batal' status by updating them to 'Selesai'
        DB::statement("UPDATE pesanans SET status_pesanan = 'Selesai' WHERE status_pesanan = 'batal'");
        
        // Then restore the original enum
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn('status_pesanan');
        });

        Schema::table('pesanans', function (Blueprint $table) {
            $table->enum('status_pesanan', ['Diterima','Sedang di Proses','Siap Diambil', 'Sedang Dikirim', 'Selesai'])
                ->after('total_harga');
        });
    }
};
