<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pizzas', function (Blueprint $table) {
            $table->dropColumn('harga'); 
            $table->integer('harga_s')->after('nama_pizza'); 
            $table->integer('harga_m')->after('harga_s'); 
            $table->integer('harga_l')->after('harga_m'); 
        });
    }

    public function down()
    {
        Schema::table('pizzas', function (Blueprint $table) {
            $table->dropColumn(['harga_s', 'harga_m', 'harga_l']); 
            $table->integer('harga')->after('nama_pizza'); 
        });
    }
};
