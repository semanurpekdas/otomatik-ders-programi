<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use App\Models\Universite; 
use Illuminate\Support\Str; // GUID ve rastgele isim için

class RegisterController extends Controller
{
    /** 
     * Show the registration form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showRegistrationForm()
    {
        $universiteler = Universite::select('id', 'isim')->get();
        return view('auth.register', compact('universiteler'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validasyon işlemi
        $this->validator($request->all())->validate();

        // Üniversiteyi bulma işlemi
        $universiteAdi = mb_convert_case($request->input('universite_adi'), MB_CASE_TITLE, "UTF-8");
        $universite = Universite::where('isim', $universiteAdi)->first();

        // Eğer üniversite bulunamazsa hata mesajıyla geri yönlendirme
        if (!$universite) {
            return redirect()->back()->withInput()->withErrors(['universite_adi' => 'Üniversite bulunamadı.']);
        }

        // Kullanıcıyı oluşturma işlemi
        event(new Registered($user = $this->create($request->all(), $universite->id)));

        // Kullanıcıyı giriş yapmış olarak oturum aç
        auth()->login($user);

        return redirect()->route('home')->with('success', 'Kayıt başarıyla tamamlandı!');
    }

    /**
     * Validate the incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'isim' => ['required', 'string', 'max:255'],
            'soyisim' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefon' => ['required', 'string', 'max:15'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'universite_adi' => ['required', 'string'],
            'profilimg' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Resim validasyonu
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @param  int  $uniId
     * @return \App\Models\User
     */
    protected function create(array $data, $uniId)
    {
        // Benzersiz GUID oluşturma
        $guid = Str::uuid();

        // Profil resmi işlemi
        $profilImgPath = null;
        if (isset($data['profilimg'])) {
            $randomFileName = Str::random(20) . '.' . $data['profilimg']->getClientOriginalExtension();
            $profilImgPath = $data['profilimg']->storeAs('images/profiller', $randomFileName, 'public'); // Dosyayı kaydet
        }

        // Kullanıcıyı veritabanına ekleme
        return User::create([
            'guid' => $guid,
            'isim' => $data['isim'],
            'soyisim' => $data['soyisim'],
            'email' => $data['email'],
            'telefon' => $data['telefon'],
            'password' => Hash::make($data['password']),
            'uni_id' => $uniId, // Üniversite ID'si
            'bolum_id' => 1, // Bölüm ID'si varsayılan olarak 1
            'unvan' => $data['unvan'],
            'profilimg_path' => $profilImgPath, // Resmin kaydedilen yolunu veritabanına kaydet
        ]);
    }
}
