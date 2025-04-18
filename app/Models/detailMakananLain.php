<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailMakananLain extends Model
{
    use HasFactory;

    protected $fillable = ['pesanan_id', 'makanan_lain_id', 'jumlah', 'subtotal'];

    public function pesanan()
    {
        return $this->belongsTo(pesanan::class);
    }

    public function makananLain()
    {
        return $this->belongsTo(makananLain::class);
    }

    protected static function booted()
    {
        static::saving(function ($detail) {
            $makanan = makananLain::find($detail->makanan_lain_id);
            if ($makanan) {
                $detail->subtotal = $makanan->harga * $detail->jumlah;
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
