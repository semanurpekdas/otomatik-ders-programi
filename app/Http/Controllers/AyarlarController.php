<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ayar;
use Illuminate\Support\Facades\Auth;

class AyarlarController extends Controller
{
    protected $user;

    public function __construct()
    {
        // Oturum açmış kullanıcının bilgilerini alıyoruz
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user(); // Oturum açmış kullanıcıyı al
            view()->share('user', $this->user); // Kullanıcı bilgilerini tüm view'lere paylaş
            return $next($request);
        });
    }

    // Ayarlar sayfası için index fonksiyonu
    public function index()
    {
        $bolumId = $this->user->bolum_id;
        $ayarlar = Ayar::where('bolum_id', $bolumId)->first();
    
        // Eğer ayarlar tablosunda bolum_id'ye göre kayıt yoksa, oluştur
        if (!$ayarlar) {
            $ayarlar = Ayar::create(['bolum_id' => $bolumId]);
        }
    
        // Yıl ve dönemi parçalama
        $yil = null;
        $donem = null;
        if ($ayarlar && $ayarlar->yıl_donem) {
            $yilDonemArray = explode(' / ', $ayarlar->yıl_donem);
            $yil = $yilDonemArray[0] ?? null;
            $donem = $yilDonemArray[1] ?? null;
        }
    
        return view('main.ayarlar', compact('ayarlar', 'yil', 'donem'));
    }
    
    
    
    

    public function update(Request $request)
    {
        $userBolumId = $this->user->bolum_id;
        
        // Form verilerini doğrulama
        $request->validate([
            'gunluk_ders_saati' => 'required|integer',
            'yil_donem_yil' => 'required|string',
            'yil_donem_donem' => 'required|string',
            'ara_saati' => 'nullable|integer',
            'renklendirme_secim' => 'required|string', // Bu artık string olacak
            'haftanin_gunleri' => 'nullable|array',
            'online_ders_sinifa_yerlestirme' => 'required|boolean',
        ]);
    
        // Yıl ve Dönemi birleştiriyoruz
        $yilDonem = $request->input('yil_donem_yil') . ' / ' . $request->input('yil_donem_donem');
    
        // Veriyi güncelle
        $ayar = Ayar::updateOrCreate(
            ['bolum_id' => $userBolumId],
            [
                'gunluk_ders_saati' => $request->input('gunluk_ders_saati'),
                'yıl_donem' => $yilDonem,
                'ara_saati' => $request->input('ara_saati'),
                'renklendirme_secim' => $request->input('renklendirme_secim'), // String olarak tutulacak
                'haftanin_gunleri' => json_encode($request->input('haftanin_gunleri'), JSON_UNESCAPED_UNICODE), // Türkçe karakterler için
                'online_ders_sinifa_yerlestirme' => $request->input('online_ders_sinifa_yerlestirme'),
            ]
        );
    
        return redirect()->back()->with('success', 'Ayarlar başarıyla güncellendi.');
    }
    
    
    
    
}
