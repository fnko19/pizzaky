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

    $token = Str::random(60);

    $hashedToken = Hash::make($token);

    PasswordResetToken::updateOrCreate(
        ['email' => $request->email],
        [
            'email' => $request->email,
            'token' => $hashedToken,
            'created_at' => now(),
        ]
    );

    $user = User::where('email', $request->email)->first();

    try {
        Mail::to($user->email)->send(new ResetPasswordMail($token, $user->email));
        return redirect()->route('forgot-password')->with('success', 'Kami telah mengirimkan link reset password ke email anda. Jika tidak menemukannya, coba periksa folder spam.');
    } catch (\Exception $e) {
        return redirect()->route('forgot-password')->with('failed', 'Terjadi kesalahan saat mengirim email reset password. Silakan coba lagi.');
    }
}


    public function validasi_forgot_password(Request $request, $token)
    {
        $email = $request->query('email');

        $getToken = PasswordResetToken::where('token', $token)
                                    ->where('email', $email)
                                    ->first();

        if (!$getToken) {
            return redirect()->route('login')->with('failed', 'Token tidak valid');
        }

        return view('auth.validasi-token', [
            'token' => $token,
            'email' => $email
        ]);
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan.',
            ]);
        }
    
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Password salah.',
            ]);
        }
    
        Auth::login($user);
        $request->session()->regenerate();
    
        return redirect()->route('home');
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

    // Menampilkan halaman reset password
public function showResetForm($token)
{
    $reset = PasswordResetToken::where('email', $request->email)->first();

    if (!$reset || !Hash::check($request->token, $reset->token)) {
        return back()->withErrors(['email' => 'Token tidak valid']);
    }

    return view('auth.validasi-token', [
        'token' => $token,
        'email' => $reset->email
    ]);
}

public function updatePassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $reset = PasswordResetToken::where('email', $request->email)->first();
    
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'User tidak ditemukan.']);
    }

    $user->password = Hash::make($request->password);
    $user->setRememberToken(Str::random(60));
    $user->save();

    PasswordResetToken::where('email', $request->email)->delete();

    return redirect()->route('login')->with('success', 'Password berhasil diperbarui. Silakan login dengan password baru.');
}


}
