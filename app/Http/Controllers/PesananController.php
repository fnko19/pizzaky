<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'pesanan_id' => 'required|exists:pesanans,id',
            'rasa' => 'nullable|array',
            'rasa.*' => 'exists:rasa_pizzas,id',
            'extra_topping' => 'nullable|array',
            'extra_pinggiran' => 'nullable|array',
            'jumlah' => 'required|numeric|min:1',
            'subtotal' => 'required|numeric|min:0',
        ]);

        // Gunakan transaksi untuk memastikan konsistensi data
        DB::beginTransaction();

        try {
            // Simpan detail pesanan
            $detailPesanan = new DetailPesanan();
            $detailPesanan->pizza_id = $request->input('pizza_id');
            $detailPesanan->pesanan_id = $request->input('pesanan_id');
            $detailPesanan->jumlah = $request->input('jumlah');
            $detailPesanan->subtotal = $request->input('subtotal');
            $detailPesanan->ekstraTopping = $request->input('extra_topping', []);
            $detailPesanan->extra_pinggiran = $request->input('extra_pinggiran', []);
            $detailPesanan->save();

            // Simpan relasi rasa ke tabel pivot
            $rasaIds = $request->input('rasa', []);
            if (!empty($rasaIds)) {
                $detailPesanan->rasaPizzas()->attach($rasaIds);
            }

            DB::commit();

            return redirect()->route('keranjang.index')->with('success', 'Pesanan berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan pesanan: ' . $e->getMessage()]);
        }
    }
}
