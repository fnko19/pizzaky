<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RasaFavorit extends Model
{
    use HasFactory;

    protected $fillable = [
        'bulan',
        'nama_rasa',
        'desc_singkat',
        'image_path',
    ];

}
