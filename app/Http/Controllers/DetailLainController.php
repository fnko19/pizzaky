<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\detailMakananLain;
use App\Models\makananLain;
use App\Models\pesanan;

class DetailLainController extends Controller
{
    public function show($id)
    {

        $makananlain = MakananLain::findOrFail($id);

        $user = auth()->user();

        $pesananAktif = $user->pesanan()
            ->where('status_pesanan', 'Sedang di Proses')
            ->first();

        if (!$pesananAktif) {
            $pesananAktif = $user->pesanan()->create([
                'total_harga' => 0,
                'status_pesanan' => 'Sedang di Proses',
            ]);
        }

        return view('filament.pages.detail_lain', compact('makananlain', 'pesananAktif'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pesanan_id' => 'required|exists:pesanans,id',
            'makanan_lain_id' => 'required|exists:makanan_lains,id',
            'jumlah' => 'required|integer|min:1',
        ]);


        detailMakananLain::create([
            'pesanan_id' => $validated['pesanan_id'],
            'makanan_lain_id' => $validated['makanan_lain_id'],
            'jumlah' => $validated['jumlah']
        ]);

        return redirect()->route('makananlain.detail', $validated['makanan_lain_id'])
            ->with('success', 'Pizza berhasil dimasukkan ke keranjang!');
    }

public function someMethod()
{
    $makananlain = MakananLain::findOrFail($id);

    // Ambil user dan pesanan aktif seperti di show()
    $user = auth()->user();

    $pesananAktif = $user->pesanan()
        ->where('status_pesanan', 'Sedang di Proses')
        ->first();

    if (!$pesananAktif) {
        $pesananAktif = $user->pesanan()->create([
            'total_harga' => 0,
            'status_pesanan' => 'Sedang di Proses',
        ]);
    }

    return view('filament.pages.detail_lain', compact('makananlain', 'pesananAktif'));
}


}
