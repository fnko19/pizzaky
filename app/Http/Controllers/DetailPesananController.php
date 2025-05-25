<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\detailPesanan;
use App\Models\pizza;

class DetailPesananController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'rasa' => 'array|required',
            'rasa.*' => 'exists:rasa_pizzas,id',
            'extra_topping' => 'nullable|array',
            'extra_topping.*' => 'string',
            'extra_pinggiran' => 'nullable|array',
            'extra_pinggiran.*' => 'string',
            'jumlah' => 'required|integer|min:1',
        ]);
   
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

        $pizza = Pizza::findOrFail($validated['pizza_id']);

    $detailPesanan = new detailPesanan();
    $detailPesanan->pizza_id = $validated['pizza_id'];
    $detailPesanan->pesanan_id = $pesananAktif->id;  // wajib!

    $detailPesanan->ekstraTopping = isset($validated['extra_topping']) ? implode(',', $validated['extra_topping']) : null;
    $detailPesanan->ekstraPinggiran = isset($validated['extra_pinggiran']) ? implode(',', $validated['extra_pinggiran']) : null;
    $detailPesanan->jumlah = $validated['jumlah'];

    // Hitung subtotal: contoh harga pizza dikali jumlah, bisa ditambah topping dll
    $detailPesanan->subtotal = $pizza->harga * $detailPesanan->jumlah;

    $detailPesanan->save();

    $detailPesanan->rasaPizzas()->sync($validated['rasa']);

    return redirect()->back()->with('success', 'Pesanan berhasil ditambahkan.');
    }
}
