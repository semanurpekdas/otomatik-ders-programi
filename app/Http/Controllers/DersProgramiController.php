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
        $bolum_id = $this->user->bolum_id;
    
        $ayarlar = Ayar::where('bolum_id', $bolum_id)->first();
        if (!$ayarlar) {
            return redirect()->back()->with('error', 'Ayarlar bulunamadı.');
        }
    
        $donem = explode(' / ', $ayarlar->yıl_donem)[1];
    
        $dersler = Ders::where('bolum_id', $bolum_id)
            ->where('donem', $donem)
            ->get();
    
        $dersProgrami = [];
        foreach ($dersler as $ders) {
            $akademisyen = Akademisyen::find($ders->hoca_id);
            if ($akademisyen) {
                // Eğer ders_sinif null ise tek parça ders
                if (is_null($ders->ders_sinif)) {
                    $dersProgrami[] = [
                        'id' => $ders->id,
                        'ders_adi' => $ders->ders_adi,
                        'hoca_isim' => $akademisyen->isim,
                        'hoca_soyisim' => $akademisyen->soyisim,
                        'ders_saati' => $ders->ders_sayisi,
                    ];
                } else {
                    // Parçalanmış dersler için her bir parça ayrı olarak eklenir
                    $dersSinifParcalari = json_decode($ders->ders_sinif, true);
                    foreach ($dersSinifParcalari as $parca) {
                        $dersProgrami[] = [
                            'id' => $ders->id,
                            'ders_adi' => $ders->ders_adi,
                            'hoca_isim' => $akademisyen->isim,
                            'hoca_soyisim' => $akademisyen->soyisim,
                            'ders_saati' => $parca, // Parçalanmış dersin saat bilgisi
                        ];
                    }
                }
            }
        }
    
        // DersProgramiSartlari modelinden verileri al
        $dersProgramiSartlari = DersProgramiSartlari::where('bolum_id', $bolum_id)->first();
    
        // Kaydedilmiş dersleri çözümle
        $kayitlar = [];
        if ($dersProgramiSartlari && $dersProgramiSartlari->ders_sartlari) {
            $kayitlar = json_decode($dersProgramiSartlari->ders_sartlari, true);
        }
    
        $gunler = json_decode($ayarlar->haftanin_gunleri, true);
    
        return view('main.dersprogrami', compact('ayarlar', 'dersProgrami', 'gunler', 'kayitlar'));
    }
    
    
    
    
    
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dersler' => 'required|array',
            'dersler.*.ders_akademisyen' => 'required|string',
            'dersler.*.gun' => 'required|string',
            'dersler.*.ders_saati' => 'required|integer|min:1',
        ]);
    
        $dersSartlari = collect($request->input('dersler'))->map(function ($ders) {
            [$dersId, $dersSaati] = explode('_', $ders['ders_akademisyen']);
            return [
                $dersId,        // Ders ID
                $ders['gun'],   // Gün
                $ders['ders_saati'], // Ders Saati
                $dersSaati,     // Dersin Süresi
            ];
        });
    
        DersProgramiSartlari::updateOrCreate(
            ['bolum_id' => auth()->user()->bolum_id],
            [
                'sinif_cakismamasi' => 1,
                'akademisyen_cakismamasi' => 1,
                'salon_cakismamasi' => 1,
                'sart_sayisi' => $dersSartlari->count(),
                'ders_sartlari' => json_encode($dersSartlari->toArray(), JSON_UNESCAPED_UNICODE),
            ]
        );
    
        return redirect()->back()->with('success', 'Ders programı başarıyla kaydedildi.');
    }
    
    
}
