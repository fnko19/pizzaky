<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pizza;
use App\Models\makananLain;
use App\Models\pizzaPanjang;

class MenuController extends Controller
{

    public function index()
    {
        $menus = Pizza::all(); 
        $lains = MakananLain::all(); 
        $panjangs = pizzaPanjang::all();
        return view('filament.pages.menu', compact('menus', 'lains', 'panjangs'));

    }

}

