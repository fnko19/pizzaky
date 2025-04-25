<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Filament\Facades\Filament;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

Route::get('forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
});

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/daftar', function (){
    return view('auth.daftar');
})->name('daftar');

Route::post('/daftar', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ]);

    User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
    ]);

    return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
});

Route::get('/home', function () {
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





