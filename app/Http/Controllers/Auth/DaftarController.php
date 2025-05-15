<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DaftarController extends Controller
{
    public function register(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => 'required|email|unique:users,email',
            'password' => bcrypt($validated['password']),
        ]);

        auth()->login($user);

        return redirect()->route('home');  
    }

}
