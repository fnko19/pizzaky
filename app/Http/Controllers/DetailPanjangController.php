<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPizzaPanjang;
use App\Models\PizzaPanjang;
use App\Models\pesanan;

class DetailPanjangController extends Controller
{
    public function show($id)
    {

        $pizzapanjang = PizzaPanjang::findOrFail($id);

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

        return view('filament.pages.detail_panjang', compact('pizzapanjang', 'pesananAktif'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pesanan_id' => 'required|exists:pesanans,id',
            'pizza_panjang_id' => 'required|exists:pizza_panjangs,id',
            'jumlah' => 'required|integer|min:1',
        ]);


        DetailPizzaPanjang::create([
            'pesanan_id' => $validated['pesanan_id'],
            'pizza_panjang_id' => $validated['pizza_panjang_id'],
            'jumlah' => $validated['jumlah']
        ]);

        return redirect()->route('pizzapanjang.detail', $validated['pizza_panjang_id'])
            ->with('success', 'Pizza berhasil dimasukkan ke keranjang!');
    }

public function someMethod()
{
    // Contoh, ambil pizza pertama saja dari database
    $pizzapanjang = PizzaPanjang::first();

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

    return view('filament.pages.detail_panjang', compact('pizzapanjang', 'pesananAktif'));
}


}
