<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\PizzaPanjangController;
use App\Http\Controllers\MakananLainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FeedbackHomeController;
use App\Http\Controllers\RasaFavoritController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\PasswordResetToken;

// --- Auth Routes ---
// Login
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
});

//Forgot Password
Route::get('forgot-password', [LoginController::class, 'forgot_password'])->name('forgot-password');
Route::post('forgot-password-act', [LoginController::class, 'forgot_password_act'])->name('forgot-password-act');

Route::get('/reset-password/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');

// Menangani POST dari form reset password
Route::get('/validasi-forgot-password/{token}', [LoginController::class, 'validasi_forgot_password'])->name('validasi-forgot-password');
Route::get('/reset-password/{token}', function ($token){
    $reset = \App\Models\PasswordResetToken::where('token', $token)->first();

    if (!$reset) {
        return redirect()->route('login')->with('failed', 'Token tidak valid');
    }

    return view('auth.validasi-token', [
        'token' => $token,
        'email' => $reset->email
    ]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $reset = PasswordResetToken::where('email', $request->email)
        ->where('token', $request->token)
        ->first();

    if (!$reset) {
        return back()->withErrors(['token' => 'Token tidak valid atau sudah kadaluarsa.']);
    }

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Email tidak terdaftar.']);
    }

    $user->password = Hash::make($request->password);
    $user->save();

    // Hapus token setelah digunakan
    PasswordResetToken::where('email', $request->email)->delete();

    return redirect()->route('login')->with('status', 'Password berhasil direset!');
})->middleware('guest')->name('password.update');

// Register
Route::get('/daftar', function () {
    return view('auth.daftar');
})->name('daftar');

Route::post('/daftar', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
});

// Logout
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// --- Public Routes ---
Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', [RasaFavoritController::class, 'index'])->name('home');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::get('/pizza/{id}', [PizzaController::class, 'show'])->name('pizza.show');
Route::get('/pizza/{id}', [PizzaController::class, 'show'])->name('detail');

Route::get('/pizzapanjang/{id}', [PizzaPanjangController::class, 'show'])->name('pizzapanjang.detail');

Route::get('/makananlain/{id}', [MakananLainController::class, 'show'])->name('makananlain.detail');

Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');
Route::get('/export-laporan', function(Request $request) {
    $bulan = $request->get('bulan');
    return Excel::download(new LaporanPenjualanExport($bulan), 'laporan_penjualan_'.$bulan.'.xlsx');
})->name('export-laporan');


// --- Protected Routes (butuh login) ---
Route::middleware('auth')->group(function () {
    
    Route::get('/feedback', function () {
        return view('filament.pages.feedback');
    })->name('feedback');

    Route::get('/pemesanan', function () {
        return view('filament.pages.pemesanan');
    })->name('pemesanan');

    Route::get('/status_pesanan', function () {
        return view('filament.pages.status_pesanan');
    })->name('status_pesanan');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store'); 
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');

});
