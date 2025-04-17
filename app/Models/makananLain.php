<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class makananLain extends Model
{
    use HasFactory;

    protected $fillable = ['nama_makanan', 'harga', 'stok', 'deskripsi', 'image_path'];

    public function detailMakananLains()
    {
        return $this->hasMany(detailMakananLain::class);
    }
}
