<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\feedback;

class ProfileController extends Controller
{
public function show()
{
    $user = auth()->user();
    $feedbacks = Feedback::with('user')->where('user_id', $user->id)->get();

    return view('filament.pages.profile', compact('user', 'feedbacks'));
}


public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'telepon' => 'required|string',
        'alamat' => 'required|string|max:255',
        'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    try {
        // Simpan foto
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_profil', 'public');
            $validated['foto'] = $fotoPath;
        }

        $user = User::create([
            'name' => $validated['nama'],
            'email' => $validated['email'],
            'no_telp' => $validated['telepon'],
            'alamat' => $validated['alamat'],
            'foto' => $validated['foto'],
        ]);

        return redirect()->route('profile', ['id' => $user->id])->with('success', 'Data berhasil disimpan.');
    } catch (\Exception $e) {
        return back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
    }
}


    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->route('profile')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'no_telp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',  
        ]);
    
        $user = User::findOrFail($id);
        
        // Update data lain
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->no_telp = $request->input('no_telp');
        $user->alamat = $request->input('alamat');
    
        // Menangani pengunggahan foto
        if ($request->hasFile('foto')) {
            // Menghapus foto lama jika ada
            if ($user->foto && file_exists(storage_path('app/public/' . $user->foto))) {
                unlink(storage_path('app/public/' . $user->foto));
            }
    
            // Menyimpan foto baru
            $fotoPath = $request->file('foto')->store('foto_profil', 'public');
            $user->foto = $fotoPath;
        }
    
        $user->save();
    
        return redirect()->route('profile', $user->id)->with('success', 'Profil berhasil diperbarui.');
    }    
    
}
