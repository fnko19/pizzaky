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
        'note',
        'opsi_pengambilan',
        'whatsapp_driver',
        'ongkir',
        'total_bayar',
    ];
    
    // Map status values from database to PRD requirements
    public function getStatusDisplay()
    {
        $status = $this->status_pesanan;
        
        // Map existing database status to PRD requirements
        $statusMap = [
            'Sedang di Proses' => 'disiapkan',
            'Sedang Dikirim' => 'dikirim',
            'Selesai' => 'diterima',
            'batal' => 'batal',
            'Siap Diambil' => 'siap_diambil',
            'Diterima' => 'diterima',
        ];
        
        return $statusMap[$status] ?? $status;
    }
    
    // Get the human-readable status message for display
    public function getStatusMessage()
    {
        // Special case for cancelled orders - we always show this message regardless of payment status
        if ($this->status_pesanan === 'batal') {
            return "Pesanan anda berhasil dibatalkan";
        }
        
        // Special case for received orders
        if ($this->status_pesanan === 'Selesai' || $this->status_pesanan === 'Diterima') {
            return "Pesanan ini sudah anda terima";
        }
        
        // If payment is not confirmed yet, payment status takes precedence
        if ($this->pembayaran && $this->pembayaran->getStatusDisplay() !== 'terkonfirmasi') {
            return "Menunggu Status Pembayaran Terkonfirmasi";
        }
        
        // Otherwise show the order status message based on status_pesanan
        $status = $this->status_pesanan;
        switch ($status) {
            case 'Sedang di Proses':
                return "Pesanan anda sedang disiapkan";
            case 'Sedang Dikirim':
                return "Pesanan anda sedang dalam perjalanan";
            case 'Siap Diambil':
                return "Pesanan sudah siap diambil 😊!";
            default:
                return "Status tidak diketahui";
        }
    }
    
    public function isCancelled()
    {
        return $this->status_pesanan === 'batal';
    }
    
    public function cancel()
    {
        $this->status_pesanan = 'batal';
        return $this->save();
    }

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
