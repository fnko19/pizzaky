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
        Schema::table('pizzas', function (Blueprint $table) {
            $table->enum('ukuran', ['S', 'M', 'L', 'Limo', '1', '2']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pizzas', function (Blueprint $table) {
            $table->dropColumn('ukuran');
        });
    }
};