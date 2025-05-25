<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Str;


class LoginController extends Controller
{
 
    public function create(): View
    {
        return view('auth.login');
    }

    public function forgot_password(){
        return view('auth.forgot-password');
    }

    public function forgot_password_act(Request $request)
{
    $customMessage = [
        'email.required'    => 'Email tidak boleh kosong',
        'email.email'       => 'Email tidak valid',
        'email.exists'      => 'Email tidak terdaftar di database',
    ];

    $request->validate([
        'email' => 'required|email|exists:users,email'
    ], $customMessage);

    $token = Str::random(64);

    PasswordResetToken::updateOrCreate(
        ['email' => $request->email],
        [
            'token' => $token,  // Simpan token plain
            'created_at' => now()
        ]
    );

    // Kirim token plain ke email
    Mail::send('auth.mail-reset-password', [
        'token' => $token,
        'email' => $request->email
    ], function ($message) use ($request) {
        $message->to($request->email);
        $message->subject('Reset Password');
    });

    return back()->with('success', 'Link reset password telah dikirim ke email Anda, jika tidak menemukan, periksa folder spam');
}


    public function validasi_forgot_password(Request $request, $token)
{
    $email = $request->query('email');

    $getToken = PasswordResetToken::where('email', $email)->first();

    if (!$getToken || $token !== $getToken->token) {
        return redirect()->route('login')->with('failed', 'Token tidak valid');
    }

    return view('auth.validasi-token', [
        'token' => $token,
        'email' => $email
    ]);
}

public function showResetForm(Request $request, $token)
{
    $email = $request->query('email');

    $reset = PasswordResetToken::where('email', $email)->first();

    if (!$reset || $token !== $reset->token) {
        return back()->withErrors(['token' => 'Token tidak valid']);
    }

    return view('auth.validasi-token', [
        'token' => $token,
        'email' => $email
    ]);
}


    public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors([
            'email' => 'Email tidak ditemukan',
        ]);
    }

    if (!Hash::check($request->password, $user->password)) {
        return back()->withErrors([
            'password' => 'Password salah',
        ]);
    }

    Auth::login($user);
    $request->session()->regenerate();

    return redirect()->intended('/home');

    dd([
    'input_email' => $request->email,
    'db_email' => $user ? $user->email : 'not found',
    'password_valid' => $user ? Hash::check($request->password, $user->password) : false
]);
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    

    public function updatePassword(Request $request)
{
    // Validasi input
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    // Cari token valid di tabel password_reset_tokens
    $reset = PasswordResetToken::where('email', $request->email)
                ->where('token', $request->token)
                ->first();

    if (!$reset) {
        return back()->withErrors(['token' => 'Token tidak valid atau sudah kadaluarsa.']);
    }

    // Cari user berdasarkan email
    $user = User::where('email', $request->email)->first();
    if (!$user) {
        return back()->withErrors(['email' => 'Email tidak terdaftar.']);
    }

    // Update password user tanpa cek password lama
    $user->password = Hash::make($request->password);
    $user->save();

    if (!$user->save()) {
    return back()->withErrors(['error' => 'Gagal menyimpan password baru']);
}

    // Hapus token setelah berhasil reset
    PasswordResetToken::where('email', $request->email)->delete();

    return redirect()->route('login')->with('status', 'Password berhasil direset!');
}

}
