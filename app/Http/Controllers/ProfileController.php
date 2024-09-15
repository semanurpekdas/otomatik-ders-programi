<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Storage sınıfını ekleyelim
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    protected $user;

    public function __construct()
    {
        // Oturum açmış kullanıcının bilgilerini alıyoruz
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user(); // Oturum açmış kullanıcıyı al

            // Kullanıcının üniversite ve bölüm bilgilerini getiriyoruz
            if ($this->user->uni_id) {
                $this->universite = \App\Models\Universite::select('isim', 'img_yolu')->where('id', $this->user->uni_id)->first();
            }

            if ($this->user->bolum_id) {
                $this->bolum = \App\Models\Bolum::select('bolum_isim')->where('id', $this->user->bolum_id)->first();
            }

            // Kullanıcı bilgilerini, üniversite ve bölüm bilgilerini view'lere paylaşıyoruz
            view()->share([
                'user' => $this->user,
                'universite' => $this->universite ?? null,  // Üniversite bilgisi
                'bolum' => $this->bolum ?? null,  // Bölüm bilgisi
            ]);

            return $next($request);
        });
    }

    public function index()
    {
        // Üniversiteleri ve bölümleri alıyoruz
        $universiteler = \App\Models\Universite::select('id', 'isim')->get();
        $bolumler = \App\Models\Bolum::with('fakulte.universite')->get();
    
        return view('main.profil', compact('universiteler', 'bolumler'));
    }

    public function updatePhoto(Request $request)
    {
        $user = auth()->user();
    
        // Validasyon: Sadece resim dosyası kabul ediliyor
        $request->validate([
            'profilimg' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Eski resmi sil (varsa)
        if ($user->profilimg_path) {
            Storage::disk('public')->delete($user->profilimg_path);
        }
    
        // Yeni resmi kaydet
        if ($request->hasFile('profilimg')) {
            $image = $request->file('profilimg');
            $imagePath = $image->store('images/profiller', 'public');
    
            // Kullanıcı profilini güncelle
            $user->profilimg_path = $imagePath;
            $user->save();
        }
    
        return redirect()->back()->with('success', 'Profil fotoğrafı başarıyla güncellendi.');
    }

    public function update(Request $request)
    {
        // Validasyon
        $request->validate([
            'isim' => 'required|string|max:255',
            'soyisim' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefon' => 'nullable|string|max:15',
            'password' => 'nullable|string|min:8|confirmed',
            'unvan' => 'required|string|max:255',
            'universite' => 'required|string|max:255',
            'bolum' => 'required|string|max:255',
        ]);
    
        // Oturum açmış kullanıcıyı al
        $user = Auth::user();
    
        // Üniversite adını uygun formata çevir
        $universiteAdi = mb_convert_case($request->input('universite'), MB_CASE_TITLE, "UTF-8");
    
        // Üniversiteyi veritabanında bul
        $universite = \App\Models\Universite::where('isim', $universiteAdi)->first();
    
        if (!$universite) {
            return redirect()->back()->withErrors(['universite' => 'Böyle bir üniversite bulunamadı.']);
        }
    
        // Bölüm adını uygun formata çevir
        $bolumAdi = mb_convert_case($request->input('bolum'), MB_CASE_TITLE, "UTF-8");
    
        // Bölümü veritabanında bul, bu üniversiteye ait olup olmadığını kontrol et
        $bolum = \App\Models\Bolum::where('bolum_isim', $bolumAdi)
                                  ->where('uni_id', $universite->id)
                                  ->first();
    
        if (!$bolum) {
            return redirect()->back()->withErrors(['bolum' => 'Bu üniversitede böyle bir bölüm bulunamadı.']);
        }
    
        // Kullanıcı bilgilerini güncelle
        $user->isim = $request->input('isim');
        $user->soyisim = $request->input('soyisim');
        $user->email = $request->input('email');
        $user->telefon = $request->input('telefon');
        $user->unvan = $request->input('unvan');
    
        // Eğer şifre güncellenmişse
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
    
        // Üniversite ve bölüm id'lerini kullanıcıya ata ve kaydet
        $user->uni_id = $universite->id;
        $user->bolum_id = $bolum->id;
    
        // Kullanıcı bilgilerini kaydet
        $user->save();
    
        // Başarı mesajı ile geri döndür
        return redirect()->back()->with('success', 'Profil başarıyla güncellendi.');
    }
}
