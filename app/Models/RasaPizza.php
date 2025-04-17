<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RasaPizza extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_rasa',
        'deskripsi',
    ];

    public function detailPesanans()
    {
        return $this->belongsToMany(detailPesanan::class, 'pizza_rasa_detail_pesanans');
    }

}
