<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{

public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|string|max:255',
        'kategori' => 'required|string',
        'isi' => 'required|string',
    ]);

    Feedback::create($request->all());

    return redirect()->back()->with('success', 'Terima kasih atas feedback Anda!');
}


}
