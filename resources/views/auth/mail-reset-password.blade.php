<div style="font-family: Arial, sans-serif; max-width: 500px; margin: auto; border: 1px solid #ddd; border-radius: 8px; padding: 24px; background-color: #ffffff;">
    <h2 style="color: #000; font-size: 20px font-weight: bold;;">Halo!!</h2>
    <p style="color: #444; font-size: 16px; line-height: 1.5; margin-top: 16px; text-align: justify;">
        Anda menerima email ini karena kami menerima permintaan untuk reset password akun Anda. Silakan klik tombol di bawah ini untuk mengatur ulang password Anda:
    </p>

    <div style="text-align: center; margin: 24px 0;">
    <a href="{{ url('reset-password/' . $token) }}?email={{ $email }}"
           style="background-color: #000000; color: #ffffff; padding: 12px 24px; text-decoration: none; font-weight: bold; border-radius: 6px; display: inline-block;">
           🔐 Reset Password
        </a>
    </div>
    
    <p style="color: #444; font-size: 16px;">
        Abaikan email ini jika Anda tidak meminta reset password.
    </p>
</div>
