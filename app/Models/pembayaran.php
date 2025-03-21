<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesanan_id',
        'metode_bayar',
        'status_bayar',
        'file_path',
    ];

    public function pesanan()
    {
        return $this->belongsTo(pesanan::class);
    }
}
