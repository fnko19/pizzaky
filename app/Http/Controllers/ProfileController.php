<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        // Data dummy pengguna (biasanya berasal dari database)
        $user = [
            'nama' => 'Pani',
            'email' => 'panitipani@gmail.com',
            'telepon' => '089799699599',
            'alamat' => 'Borongloe, Kec. Bontomarannu, Gowa',
            'avatar' => 'images/profile.png',
        ];

        // Data dummy riwayat pembelian
        $riwayatPembelian = [
            [
                'nama' => 'Pizza Classic Ukuran L',
                'rasa' => 'Tuna melt',
                'topping' => 'keju',
                'pinggiran' => 'Sosis',
                'tanggal' => '09/10/2025',
                'harga' => 65000,
                'gambar' => 'images/p1.png'
            ],
            [
                'nama' => 'Pizza Classic Ukuran S',
                'rasa' => 'Veggie Delight',
                'pinggiran' => 'Sosis',
                'tanggal' => '09/10/2025',
                'harga' => 35000,
                'gambar' => 'images/p2.jpg'
            ],
            [
                'nama' => 'Pizza Classic Ukuran S',
                'rasa' => 'Meat Lovers', 'Tuna Mayo',
                'pinggiran' => 'Sosis',
                'tanggal' => '10/10/2025',
                'harga' => 35000,
                'gambar' => 'images/p3.jpg'
            ],
            [
                'nama' => 'Pizza Classic Ukuran M',
                'rasa' => 'Tuna Cado',
                'topping' => 'keju',
                'tanggal' => '18/10/2025',
                'harga' => 55000,
                'gambar' => 'images/p4.jpg'
            ],
            [
                'nama' => 'Pizza Classic Ukuran S',
                'rasa' => 'Veggie Delight',
                'pinggiran' => 'Sosis',
                'tanggal' => '09/11/2025',
                'harga' => 35000,
                'gambar' => 'images/p2.jpg'
            ],
        ];

        return view('filament.pages.profile', compact('user', 'riwayatPembelian'));
    }

    public function update(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'telepon' => 'required',
            'alamat' => 'required|string',
        ]);

        // Simpan ke database (disesuaikan dengan model User atau lainnya)
        $user = auth()->user();
        $user->name = $validated['nama'];
        $user->email = $validated['email'];
        $user->telepon = $validated['telepon'];
        $user->alamat = $validated['alamat'];
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

}
