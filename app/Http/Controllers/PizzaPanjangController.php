<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PizzaPanjang;

class PizzaPanjangController extends Controller
{
    public function show($id)
    {
        $pizzapanjang = PizzaPanjang::findOrFail($id);
        return view('filament.pages.detail_panjang', compact('pizzapanjang'));
    }
}
