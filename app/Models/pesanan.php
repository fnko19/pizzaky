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
        'whatsapp_driver',
        'ongkir',
        'total_bayar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailPesanan()
    {
        return $this->hasMany(detailPesanan::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(pembayaran::class);
    }

    public function detailMakananLains()
    {
        return $this->hasMany(detailMakananLain::class);
    }

    public function detailPizzaPanjangs()
    {
        return $this->hasMany(\App\Models\detailPizzaPanjang::class);
    }
}
