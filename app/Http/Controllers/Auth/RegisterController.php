<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth; // Auth class'ı kullanmak için
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail; // Mail sınıfı
use App\Models\Universite;
use Illuminate\Support\Facades\URL; // URL sınıfı
use App\Mail\KullaniciKayitMaili;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        // Universiteleri çekelim
        $universiteler = Universite::select('id', 'isim')->get();
        return view('auth.register', compact('universiteler'));
    }

    public function register(Request $request)
    {
        // Validasyon işlemi
        $this->validator($request->all())->validate();

        // Üniversiteyi bulma
        $universiteAdi = mb_convert_case($request->input('universite_adi'), MB_CASE_TITLE, "UTF-8");
        $universite = Universite::where('isim', $universiteAdi)->first();

        if (!$universite) {
            return redirect()->back()->withInput()->withErrors(['universite_adi' => 'Üniversite bulunamadı.']);
        }

        // Profil resmi yükleme
        $profilimgPath = null;
        if ($request->hasFile('profilimg')) {
            $profilimg = $request->file('profilimg');
            $profilimgPath = $profilimg->storeAs('images/profiller', time() . '_' . $profilimg->getClientOriginalName(), 'public');
        }

        // Kullanıcı oluşturma
        $user = $this->create($request->all(), $universite->id, $profilimgPath);

        // E-posta doğrulama URL'si oluştur
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        // E-posta doğrulama bildirimini özelleştirilmiş olarak gönder
        Mail::to($user->email)->send(new KullaniciKayitMaili($user->isim, $verificationUrl));

        // Eğer giriş yapılmışsa, oturumu kapat
        auth()->logout();

        // Kayıttan sonra login sayfasına yönlendir, oturum açma yok
        return redirect()->route('login')->with('success', 'Kayıt başarıyla tamamlandı. Lütfen e-posta adresinizi doğrulayın.');
    }

    protected function create(array $data, $uniId, $profilimgPath = null)
    {
        $guid = Str::uuid();

        return User::create([
            'guid' => $guid,
            'isim' => $data['isim'],
            'soyisim' => $data['soyisim'],
            'email' => $data['email'],
            'telefon' => $data['telefon'],
            'password' => Hash::make($data['password']),
            'uni_id' => $uniId,
            'bolum_id' => 1,
            'unvan' => $data['unvan'],
            'profilimg_path' => $profilimgPath,
            'email_verified_at' => null,
        ]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'isim' => ['required', 'string', 'max:255'],
            'soyisim' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefon' => ['required', 'string', 'max:15'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'universite_adi' => ['required', 'string'],
        ]);
    }
}
