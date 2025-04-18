<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pizza;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Pizza::all(); 
        return view('filament.pages.menu', compact('menus'));
    }
}

