<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_harga',
        'status_pesanan',
        'opsi_pengambilan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailPesanan()
    {
        return $this->belongsTo(detailPesanan::class);
    }

    public function pembayaran()
    {
        return $this->belongsTo(pembayaran::class);
    }
}
