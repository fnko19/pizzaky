<?php

namespace App\Http\Controllers;

use App\Models\feedback;
use Illuminate\Http\Request;

class FeedbackHomeController extends Controller
{
    public function index()
    {
        $feedbacks = \App\Models\feedback::with('user')->get();
        return view('filament.pages.home', compact('feedbacks'));
    }

}
