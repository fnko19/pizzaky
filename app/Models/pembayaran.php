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
    
    // Map status values from database to PRD requirements
    public function getStatusDisplay()
    {
        $status = $this->status_bayar;
        
        // Map existing database status to PRD requirements
        $statusMap = [
            'Belum di Bayar' => 'pending',
            'Menunggu Dikonfirmasi' => 'pending',
            'Lunas' => 'terkonfirmasi',
        ];
        
        return $statusMap[$status] ?? $status;
    }
    
    // Get the human-readable status message for display
    public function getStatusMessage()
    {
        if ($this->getStatusDisplay() === 'pending') {
            return "Menunggu Pembayaran Dinotice Admin Nih 😊!";
        }
        
        return $this->status_bayar;
    }

    public function pesanan()
    {
        return $this->belongsTo(pesanan::class);
    }
}
