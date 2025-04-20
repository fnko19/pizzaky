<?php

use Illuminate\Support\Facades\Route;
use Filament\Facades\Filament;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/feedback', function () {
    return view('filament.pages.feedback');
})->name('feedback');

Route::get('/pemesanan', function () {
    return view('filament.pages.pemesanan');
})->name('pemesanan');

Route::get('/status_pesanan', function () {
    return view('filament.pages.status_pesanan');
})->name('status_pesanan');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/pizza/{id}', [PizzaController::class, 'show'])->name('pizza.show');
Route::get('/pizza/{id}', [PizzaController::class, 'show'])->name('detail');
Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::put('/profil/update', [ProfileController::class, 'update'])->name('profil.update');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');



