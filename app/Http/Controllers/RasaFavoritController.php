<?php

namespace App\Http\Controllers;

use App\Models\RasaFavorit;
use App\Models\feedback;
use Illuminate\Http\Request;

class RasaFavoritController extends Controller
{
    public function index()
    {
        $rasas = RasaFavorit::all()->groupBy('bulan');
        $feedbacks = feedback::with('user')->get();

        return view('filament.pages.home', compact('rasas','feedbacks'));
    }
}


