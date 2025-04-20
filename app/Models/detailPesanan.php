<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailPesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesanan_id',
        'pizza_id',
        'jumlah',
        'subtotal',
        'ekstraTopping',
        'extra_pinggiran'
    ];

    
    public function pesanan()
    {
        return $this->belongsTo(pesanan::class);
    }

    public function pizza()
    {
        return $this->belongsTo(pizza::class);
    }

    public function rasaPizzas()
    {
        return $this->belongsToMany(RasaPizza::class, 'pizza_rasa_detail_pesanans');
    }

    public static function booted()
    {
        static::saving(function ($detail) {
            $pizza = pizza::find($detail->pizza_id);
            if ($pizza) {
                $detail->subtotal = $pizza->harga * $detail->jumlah;
            }
        });

        static::saved(function ($detail) {
            static::updateTotalHarga($detail->pesanan_id);
        });
    
        static::deleted(function ($detail) {
            static::updateTotalHarga($detail->pesanan_id);
        });

        static::saving(function ($detail) {
            $pizza = pizza::find($detail->pizza_id);
            $jumlah = $detail->jumlah ?? 1;
    
            if ($pizza) {
                $ukuran = $pizza->ukuran;
                $harga = $pizza->harga;
                $subtotal = $harga * $jumlah;
    
                if ($ukuran === 'S' && $jumlah >= 3) {
                    $subtotal = 100000 * floor($jumlah / 3);
                    $sisa = $jumlah % 3;
                    $subtotal += $sisa * $harga;
                }

                if ($detail->ekstraPinggiran) {
                    $ekstra = [
                        'M' => ['Sosis' => 10000, 'Keju' => 15000],
                        'L' => ['Sosis' => 15000, 'Keju' => 20000],
                    ];
                    $subtotal += $ekstra[$ukuran][$detail->ekstraPinggiran] * $jumlah ?? 0;
                    
                }

                if ($detail->ekstraTopping === 'Keju') {
                    $topping = ['M' => 10000, 'L' => 15000, 'Limo' => 30000];
                    $subtotal += $topping[$ukuran] * $jumlah ?? 0;
                }
    
                $detail->subtotal = $subtotal;
            }
        });

    }

    // public function setSubtotalAttribute($value)
    // {
    //     // Promo: jika pizza ukuran 'S' dan beli 3 pizza
    //     if ($this->pizza && $this->pizza->ukuran == 'S' && $this->jumlah == 3) {
    //         $this->attributes['subtotal'] = 100000; 
    //     } else {
    //         $this->attributes['subtotal'] = $this->pizza->harga * $this->jumlah; 
    //     }
    // }

    // protected static function updateTotalHarga($pesananId)
    // {
    //     $total = self::where('pesanan_id', $pesananId)->sum('subtotal');
    
    //     \App\Models\pesanan::where('id', $pesananId)->update([
    //         'total_harga' => $total,
    //     ]);
    // }

    protected static function updateTotalHarga($pesananId)
    {
        $totalPizza = self::where('pesanan_id', $pesananId)->sum('subtotal');
        $totalMakananLain = \App\Models\detailMakananLain::where('pesanan_id', $pesananId)->sum('subtotal');
    
        $total = $totalPizza + $totalMakananLain;
    
        \App\Models\pesanan::where('id', $pesananId)->update([
            'total_harga' => $total,
        ]);
    }

}
