<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;
use App\Models\User;
use App\Models\RasaPizza;

class PizzaController extends Controller
{
    public function show($id)
    {
        $pizza = Pizza::findOrFail($id);
        $rasaPizzas = RasaPizza::all();  
        $user = auth()->user();
        $pesananAktif = $user->pesanan()->where('status_pesanan', 'Sedang di Proses')->first();
        return view('filament.pages.detail', compact('pizza', 'rasaPizzas', 'pesananAktif'));
    }
}
