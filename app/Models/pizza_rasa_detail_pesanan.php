<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pizza_rasa_detail_pesanan extends Model
{
    use HasFactory;

    //protected $table = 'pizza_rasa_detail_pesanan';

    protected $fillable = [
        'detail_pesanan_id',
        'rasa_pizza_id',
    ];

    public function detailPesanan()
    {
        return $this->belongsTo(detailPesanan::class);
    }

    public function rasaPizza()
    {
        return $this->belongsTo(RasaPizza::class);
    }
}
