<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\makananLain;

class MakananLainController extends Controller
{
    public function show($id)
    {
        $makananlain = MakananLain::findOrFail($id);
        return view('filament.pages.detail_lain', compact('makananlain'));
    }
}
