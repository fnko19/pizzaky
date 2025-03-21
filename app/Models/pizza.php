<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pizza extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pizza',
        'image_path',
        'harga_s',
        'harga_m',
        'harga_l',
        'stok',
        'deskripsi',
    ];

    public function detailPesanan()
    {
        return $this->belongsTo(detailPesanan::class);
    }
}
