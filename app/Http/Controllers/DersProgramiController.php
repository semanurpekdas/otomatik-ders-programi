<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ayar;
use App\Models\Ders;
use App\Models\Akademisyen;
use App\Models\DersProgramiSartlari;

class DersProgramiController extends Controller
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

    public function index() 
    {
        // Oturum açmış kullanıcının bolum_id'sini al
        $bolum_id = $this->user->bolum_id;
    
        // Ayarlar tablosundan kullanıcıya ait bölüm bilgisi ile ilgili kaydı al
        $ayarlar = Ayar::where('bolum_id', $bolum_id)->first();
        if (!$ayarlar) {
            return redirect()->back()->with('error', 'Ayarlar bulunamadı.');
        }
    
        // Yıl_donem değişkeninden Güz veya Bahar gibi dönem adını al
        $donem = explode(' / ', $ayarlar->yıl_donem)[1];
    
        // Dersler tablosunda bolum_id ve donem'e göre dersleri getir
        $dersler = Ders::where('bolum_id', $bolum_id)
            ->where('donem', $donem)
            ->get();
    
        // Derslerin hocalarının isim ve soyisim bilgilerini çek
        $dersProgrami = [];
        foreach ($dersler as $ders) {
            $akademisyen = Akademisyen::find($ders->hoca_id);
            if ($akademisyen) {
                $dersProgrami[] = [
                    'id' => $ders->id,  // Dersin id'sini ekliyoruz
                    'ders_adi' => $ders->ders_adi,
                    'hoca_isim' => $akademisyen->isim,
                    'hoca_soyisim' => $akademisyen->soyisim, 
                    'ders_saati' => $ders->ders_sayisi // Dersin süresi
                ];
            }
        }
    
        // Ders programı şartları tablosundan mevcut kaydı al
        $dersProgramiSartlari = DersProgramiSartlari::where('bolum_id', $bolum_id)->first();
    
        // Haftanın günlerini JSON formatından diziye dönüştür
        $gunler = json_decode($ayarlar->haftanin_gunleri, true);
    
        // Verileri view'e gönder
        return view('main.dersprogrami', compact('ayarlar', 'dersProgrami', 'gunler', 'dersProgramiSartlari'));
    }
    
    
    public function store(Request $request)
    {
        try {
            // Gelen verileri kontrol edelim
            $data = $request->all();
    
            // Ders şartlarını doğru formatta almak için json_decode kullanıyoruz
            if (!isset($data['ders_sartlari'])) {
                return response()->json(['success' => false, 'message' => 'Ders şartları eksik!'], 400);
            }
            
            $dersSartlari = json_decode($data['ders_sartlari'], true);
    
            // Mevcut bir kayıt olup olmadığını kontrol et (bolum_id ile)
            $existingRecord = DersProgramiSartlari::where('bolum_id', Auth::user()->bolum_id)->first();
    
            if ($existingRecord) {
                // Kayıt varsa update işlemi yap
                $existingRecord->update([
                    'sinif_cakismamasi' => $data['sinifcakismasi'], // doğru key
                    'akademisyen_cakismamasi' => $data['akademisyencakismasi'], // doğru key
                    'salon_cakismamasi' => $data['salonlarcakismasi'],
                    'sart_sayisi' => $data['sart_sayisi'],
                    'ders_sartlari' => json_encode($dersSartlari, JSON_UNESCAPED_UNICODE),
                ]);
    
                return response()->json(['success' => true, 'message' => 'Kayıt başarıyla güncellendi!']);
            } else {
                // Kayıt yoksa create işlemi yap
                DersProgramiSartlari::create([
                    'bolum_id' => Auth::user()->bolum_id,
                    'sinif_cakismamasi' => $data['sinifcakismasi'], // doğru key
                    'akademisyen_cakismamasi' => $data['akademisyencakismasi'], // doğru key
                    'salon_cakismamasi' => $data['salonlarcakismasi'],
                    'sart_sayisi' => $data['sart_sayisi'],
                    'ders_sartlari' => json_encode($dersSartlari, JSON_UNESCAPED_UNICODE),
                ]);
    
                return response()->json(['success' => true, 'message' => 'Veriler başarıyla kaydedildi!']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Bir hata oluştu: ' . $e->getMessage()], 500);
        }
    }
    
    
    

    
    
    
    
    
}
