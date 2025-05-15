<?php

namespace App\Http\Controllers;

use App\Models\Pizza;

class DetailController extends Controller
{
    public function show($id)
    {
        
        $details = Pizza::with('rasa')->findOrFail($id);  
        
        return view('filament.pages.detail', compact('details'));
    }

}



