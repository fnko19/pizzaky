<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailPizzaPanjang extends Model
{
    use HasFactory;

    protected $fillable = ['pesanan_id', 'pizza_panjang_id', 'jumlah', 'subtotal'];

    public function pesanan()
    {
        return $this->belongsTo(\App\Models\pesanan::class);
    }
    
    public function pizzaPanjang()
    {
        return $this->belongsTo(\App\Models\pizzaPanjang::class);
    }

    protected static function booted()
    {
        static::saving(function ($detail) {
            $pizzaPanjang = pizzaPanjang::find($detail->pizza_panjang_id);
            if ($pizzaPanjang) {
                $detail->subtotal = $pizzaPanjang->harga * $detail->jumlah;
            }
        });

        static::saved(function ($detail) {
            \App\Models\detailPesanan::updateTotalHarga($detail->pesanan_id);
        });

        static::deleted(function ($detail) {
            \App\Models\detailPesanan::updateTotalHarga($detail->pesanan_id);
        });
    }
}
