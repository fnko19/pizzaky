<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailPesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'jumlah',
        'subtotal',
        'ukuran',
        'ekstraTopping',
        'ekstraPinggiran',
    ];

    public function pesanan()
    {
        return $this->belongsTo(pesanan::class);
    }

    public function pizza()
    {
        return $this->belongsTo(pizza::class);
    }
}
