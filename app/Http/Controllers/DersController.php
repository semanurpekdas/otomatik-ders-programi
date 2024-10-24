<?php

namespace App\Http\Controllers;

use App\Models\Akademisyen;
use App\Models\Bolum;
use App\Models\Ders;
use App\Models\Salon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DersController extends Controller
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

    public function index(Request $request)
    {
        $user = $this->user;
    
        // Kullanıcının bölümü ve akademisyenler
        $bolum = Bolum::find($user->bolum_id);
        $akademisyenler = Akademisyen::where('bolum_id', $user->bolum_id)->get();
        $salonlar = Salon::where('bolum_id', $user->bolum_id)->get();
    
        // Filtreleme işlemi için query oluşturma
        $query = Ders::where('bolum_id', $user->bolum_id);
    
        // Ders ismine göre filtreleme
        if ($request->filled('isim')) {
            $query->where('ders_adi', 'LIKE', '%' . $request->input('isim') . '%');
        }
    
        // Ders hocasına göre filtreleme
        if ($request->filled('hoca_id')) {
            $query->where('hoca_id', $request->input('hoca_id'));
        }
    
        // Döneme göre filtreleme
        if ($request->filled('donem')) {
            $query->where('donem', $request->input('donem'));
        }
    
        // Sınıfa göre filtreleme
        if ($request->filled('sinif')) {
            $query->where('sinif', $request->input('sinif'));
        }
    
        // Seçmeli/Zorunlu durumuna göre filtreleme
        if ($request->filled('secmeli_durumu')) {
            $query->where('secmeli_durumu', $request->input('secmeli_durumu'));
        }

        // Döneme göre sıralama (Önce Güz, sonra Bahar)
        $query->orderByRaw("FIELD(donem, 'Güz', 'Bahar')");
    
        // Filtrelenmiş dersleri 10'lu sayfalama ile getirme
        $dersler = $query->paginate(10);
    
        return view('main.dersler', compact('bolum', 'dersler', 'akademisyenler','salonlar'));
    }
    
 
    public function addDers(Request $request)
    {
        // Gelen verileri doğrula
        $request->validate([
            'ders_adi' => 'required|string|max:255',
            'kisa_isim' => 'required|string|max:255',
            'donem' => 'required|string|in:Güz,Bahar',
            'ders_sayisi' => 'required|integer',
            'ders_parcasi' => 'required|integer',
            'sinif' => 'required|integer',
            'alan_kisi_sayisi' => 'required|integer',
            'secmeli_durumu' => 'required|boolean',
            'hoca_id' => 'required|exists:akademisyenler,id',
            'renk_kodu' => 'required|string|max:7',
            'uzaktan_egitim' => 'required|boolean',
            'salon_id' => 'nullable|array',
            'salon_id.*' => 'nullable|exists:salonlar,id',
            'ders_sinif' => 'nullable|string',
        ]);
    
        // sinif_id değerini JSON formatına çevir
        $sinifIdJson = json_encode($request->input('salon_id', []));
    
        // ders_sinif değerini JSON formatına çevir, önce array'e çeviriyoruz
        $dersSinifArray = json_decode($request->input('ders_sinif', '[]'));
        $dersSinifJson = json_encode($dersSinifArray);
    
        // Yeni dersi ekleyelim
        Ders::create([
            'ders_adi' => $request->input('ders_adi'),
            'kisa_isim' => $request->input('kisa_isim'),
            'donem' => $request->input('donem'),
            'ders_sayisi' => $request->input('ders_sayisi'),
            'ders_parcasi' => $request->input('ders_parcasi'),
            'sinif' => $request->input('sinif'),
            'alan_kisi_sayisi' => $request->input('alan_kisi_sayisi'),
            'secmeli_durumu' => $request->input('secmeli_durumu'),
            'bolum_id' => $request->user()->bolum_id,
            'hoca_id' => $request->input('hoca_id'),
            'renk_kodu' => $request->input('renk_kodu'),
            'uzaktan_egitim' => $request->input('uzaktan_egitim'),
            'sinif_id' => $sinifIdJson, // JSON formatında kaydediliyor
            'ders_sinif' => $dersSinifJson // JSON formatında kaydediliyor
        ]);
    
        return redirect()->back()->with('success', 'Ders başarıyla eklendi.');
    }

    
    public function update(Request $request, $id)
    {
        // Güncellenecek dersi buluyoruz
        $ders = Ders::findOrFail($id);
    
        // Form verilerinin doğrulanması
        $request->validate([
            'ders_adi' => 'required|string|max:255',
            'kisa_isim' => 'required|string|max:50',
            'donem' => 'required|in:Güz,Bahar',
            'ders_sayisi' => 'required|integer|min:1',
            'ders_parcasi' => 'required|integer|min:1|max:9',
            'sinif' => 'required|integer|min:1|max:9',
            'alan_kisi_sayisi' => 'required|integer|min:0',
            'secmeli_durumu' => 'required|boolean',
            'uzaktan_egitim' => 'required|boolean', // Eklenmiş doğrulama kuralı
            'hoca_id' => 'required|exists:akademisyenler,id',
            'renk_kodu' => 'required|string|size:7',
        ]);
    
        // Seçilen salonlar (sinif_id) JSON formatına çevrilir
        $sinif_id = json_encode($request->input('salon_id', []));
    
        // Ders bilgilerini güncelliyoruz
        $ders->update([
            'ders_adi' => $request->input('ders_adi'),
            'kisa_isim' => $request->input('kisa_isim'),
            'donem' => $request->input('donem'),
            'ders_sayisi' => $request->input('ders_sayisi'),
            'ders_parcasi' => $request->input('ders_parcasi'),
            'sinif' => $request->input('sinif'),
            'alan_kisi_sayisi' => $request->input('alan_kisi_sayisi'),
            'secmeli_durumu' => $request->input('secmeli_durumu'),
            'hoca_id' => $request->input('hoca_id'),
            'renk_kodu' => $request->input('renk_kodu'),
            'uzaktan_egitim' => $request->input('uzaktan_egitim'), // Uzaktan eğitim bilgisi güncelleniyor
            'sinif_id' => $sinif_id, // Seçilen salonlar (JSON formatında)
        ]);
    
        return redirect()->back()->with('success', 'Ders başarıyla güncellendi.');
    }
    

    public function delete($id)
    {
        $ders = Ders::findOrFail($id);
        $ders->delete();

        return redirect()->back()->with('success', 'Ders başarıyla silindi.');
    }



}
