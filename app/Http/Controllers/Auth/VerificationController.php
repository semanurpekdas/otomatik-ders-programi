<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\KullaniciKayitMaili; // Oluşturduğumuz mail sınıfını ekliyoruz
use Illuminate\Support\Facades\Mail; // Mail gönderimi için Mail class'ını ekliyoruz
use Illuminate\Support\Facades\URL; // URL sınıfı

class VerificationController extends Controller
{
    public function notice()
    {
        return view('auth.verify-email');
    }

    public function verify(Request $request, $id, $hash)
    {
        // ID'ye göre kullanıcıyı bul
        $user = User::findOrFail($id);
    
        // Hash doğrulamasını kontrol et
        if (! hash_equals(sha1($user->getEmailForVerification()), $hash)) {
            return redirect('/login')->withErrors(['email' => 'Doğrulama bağlantısı geçersiz.']);
        }
    
        // Eğer email zaten doğrulandıysa
        if ($user->hasVerifiedEmail()) {
            return redirect('/login')->with('verified', 'E-posta adresiniz zaten doğrulanmış.');
        }
    
        // E-posta doğrulandı, `email_verified_at` sütununu güncelle
        $user->markEmailAsVerified();
    
        return redirect('/login')->with('verified', 'E-posta doğrulamanız başarıyla gerçekleştirildi.');
    }

    public function resend(Request $request)
    {
        // Kullanıcıyı email'e göre bul
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Bu e-posta adresi ile ilgili işlem yapılamıyor.']);
        }

        if ($user->hasVerifiedEmail()) {
            return back()->withErrors(['email' => 'Bu e-posta adresi zaten doğrulanmış.']);
        }

        // Doğrulama URL'si oluşturma
        $verificationUrl = URL::signedRoute('verification.verify', ['id' => $user->id, 'hash' => sha1($user->getEmailForVerification())]);

        // KullaniciKayitMaili sınıfıyla doğrulama maili gönder
        Mail::to($user->email)->send(new KullaniciKayitMaili($user->isim, $verificationUrl));

        return back()->with('resent', 'Doğrulama e-postası tekrar gönderildi.');
    }
}
