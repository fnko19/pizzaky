<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    // Store feedback
    public function store(Request $request)
    {
        // Validate the user's input
        $request->validate([
            'nama_pengirim' => 'required|string|max:255', // Validate sender's name
            'kategori' => 'required|in:Website,Makanan,Pelayanan', // Validate category
            'isi' => 'required|string', // Validate feedback content
        ]);

        // If user is authenticated, automatically set user_id
        $userId = Auth::id();

        // Save feedback to the database
        Feedback::create([
            'nama_pengirim' => $request->nama_pengirim,
            'kategori' => $request->kategori,
            'isi' => $request->isi,
            'user_id' => $userId, // Automatically use the authenticated user's ID
        ]);

        // Redirect back with success message
        return redirect()->route('feedback')->with('success', 'Feedback berhasil dikirim!');
    }

    // Show all feedbacks
    public function index()
    {
        // Retrieve all feedbacks along with the associated user data
        $feedbacks = Feedback::with('user')->get();

        // Return the view with the feedback data
        return view('filament.pages.feedback', compact('feedbacks'));
    }
}

