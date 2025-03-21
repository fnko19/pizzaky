<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained()->onDelete('cascade');
            $table->foreignId('pizza_id')->constrained()->onDelete('cascade');
            $table->integer('jumlah');
            $table->integer('subtotal');
            $table->enum('ukuran', ['S', 'M', 'L']);
            $table->enum('ekstraTopping', ['Keju',]);
            $table->enum('ekstraPinggiran', ['Sosis', 'Keju',]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pesanans');
    }
};
