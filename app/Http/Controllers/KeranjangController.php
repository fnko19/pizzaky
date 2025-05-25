<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\pembayaran;
use App\Models\pesanan;
use App\Models\User;

class KeranjangController extends Controller
{
    public function simpan(Request $request)
    {
        $request->validate([
            'metode_bayar' => 'required|in:Transfer,COD',
        ]);

        $pesanan = pesanan::where('user_id', Auth::id())
                      ->latest()
                      ->first();

        if (!$pesanan) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }

        Pembayaran::create([
            'pesanan_id' => $pesanan->id,
            'metode_bayar' => $request->metode_bayar,
            'status_bayar' => 'Belum di Bayar', 
            'file_path' => null, 
        ]);

        return redirect()->route('status_pesanan')->with('success', 'Metode pembayaran berhasil disimpan');
    }

   public function showAktif()
{
    $user = auth()->user();

    $pesananAktif = $user->pesanan()
        ->with([
            'detailPesanan.pizza',
            'detailPesanan.rasaPizzas',
            'detailMakananLains.makananLain',
            'detailPizzaPanJangs.pizzaPanjang'
        ])
        ->where('status_pesanan', 'Sedang di Proses')
        ->first();

    return view('filament.pages.pemesanan', [
        'pesanan' => $pesananAktif
    ]);
}


}
