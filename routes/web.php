<?php

use Illuminate\Support\Facades\Route;
use Filament\Facades\Filament;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/daftar', function (){
    return view('auth.daftar');
})->name('daftar');

Route::get('/', function () {
    return view('filament.pages.home');
})->name('home');
Route::get('/detail', function () {
    return view('filament.pages.detail');
})->name('detail');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');

