<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;
use App\Models\RasaPizza;

class PizzaController extends Controller
{
    public function show($id)
    {
        $pizza = Pizza::findOrFail($id);
        $rasaPizzas = RasaPizza::all(); // ambil semua rasa
        return view('filament.pages.detail', compact('pizza', 'rasaPizzas'));
    }
}
