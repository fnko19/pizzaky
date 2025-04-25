<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pizzaPanjang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pizza',
        'image_path',
        'harga',
        'stok',
        'deskripsi',
        'desc_singkat',
    ];

    public function detailPizzaPanjangs()
    {
        return $this->hasMany(detailPizzaPanjang::class);
    }


}