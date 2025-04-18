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
        'harga',
        'stok',
        'deskripsi',
        'max_rasa',
        'ukuran',
    ];

    public function detailPesanan()
    {
        return $this->belongsTo(detailPesanan::class);
    }
}
