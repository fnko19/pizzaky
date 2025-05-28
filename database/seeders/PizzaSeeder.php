<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\pizza;
use App\Models\makananLain;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a sample pizza
        pizza::firstOrCreate(
            ['nama_pizza' => 'Margherita'],
            [
                'nama_pizza' => 'Margherita',
                'ukuran' => 'M',
                'harga' => 65000,
                'deskripsi' => 'Classic Italian pizza with tomato sauce, mozzarella cheese and fresh basil',
                'deskripsi_singkat' => 1, // Using integer as per migration
                'image_path' => 'images/pizza/margherita.jpg',
                'stok' => 10,
                'max_rasa' => 1,
            ]
        );

        // Create a sample additional food
        makananLain::firstOrCreate(
            ['nama_makanan' => 'Garlic Bread'],
            [
                'nama_makanan' => 'Garlic Bread',
                'harga' => 20000,
                'deskripsi' => 'Freshly baked bread with garlic butter and herbs',
                'deskripsi_singkatt' => 1, // Using integer as per migration
                'image_path' => 'images/makanan/garlic_bread.jpg',
                'stok' => 10,
            ]
        );
    }
}
