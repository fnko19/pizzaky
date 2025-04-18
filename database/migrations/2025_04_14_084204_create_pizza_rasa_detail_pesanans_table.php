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
        Schema::create('pizza_rasa_detail_pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('detail_pesanan_id')->constrained('detail_pesanans')->onDelete('cascade');
            $table->foreignId('rasa_pizza_id')->constrained('rasa_pizzas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pizza_rasa_detail_pesanans');
    }
};
