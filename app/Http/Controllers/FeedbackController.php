<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'kategori' => 'required|string',
            'isi' => 'required|string',
        ]);

        // Menyimpan data jika validasi berhasil
        Feedback::create($validatedData);

        // Redirect atau kirim pesan sukses
        return redirect()->route('feedback.success')->with('message', 'Feedback berhasil dikirim!');
    }

}
