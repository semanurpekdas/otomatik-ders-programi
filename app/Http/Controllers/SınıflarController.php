<?php

namespace App\Http\Controllers;

use App\Models\Bolum;
use App\Models\Fakulte;
use App\Models\Salon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SınıflarController extends Controller
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
    
        // Filtreleme işlemi
        $query = Salon::where('bolum_id', $user->bolum_id);
    
        // Fakülteye göre filtreleme
        if ($request->filled('fakulte_id')) {
            $fakulteId = $request->input('fakulte_id');
            // Fakülte ID'sine göre filtreleme
            $query->where('fakulte_id', $fakulteId);
        }
    
        // Salon adına göre filtreleme
        if ($request->filled('isim')) {
            $query->where('isim', 'LIKE', '%' . $request->input('isim') . '%');
        }
    
        // Salonları 10'lu olarak sayfalama yapıyoruz
        $salonlar = $query->paginate(10);
    
        // Kullanıcının üniversitesine göre fakülteleri ve kendi bölümünü çekiyoruz
        $fakulteler = Fakulte::where('uni_id', $user->uni_id)->get();
        $bolumler = Bolum::where('id', $user->bolum_id)->get();
    
        // Eğer kullanıcıya ait bölümde salon yoksa, mesaj ileteceğiz
        if ($salonlar->isEmpty() && !$request->has('isim')) {
            return view('main.sınıflar', compact('salonlar', 'fakulteler', 'bolumler'))
                ->withErrors(['message' => 'Bölümünüzde salon kaydı bulunamadı, lütfen ekleme yapınız.']);
        }
    
        return view('main.sınıflar', compact('salonlar', 'fakulteler', 'bolumler'));
    }
    

    public function store(Request $request)
    {
        // Validasyon
        $request->validate([
            'isim' => 'required|string|max:255',
            'fakulte_id' => 'required|exists:fakulteler,id',
            'bolum_id' => 'required|exists:bolumler,id',
            'kapasite' => 'required|integer',
            'renk_kodu' => 'required|string|max:7',
        ]);

        // Yeni salon ekleme
        Salon::create([
            'guid' => (string) \Illuminate\Support\Str::uuid(),
            'isim' => $request->isim,
            'fakulte_id' => $request->fakulte_id,
            'bolum_id' => $request->bolum_id,
            'kapasite' => $request->kapasite,
            'renk_kodu' => $request->renk_kodu,
        ]);

        return redirect()->route('sınıflar.index')->with('success', 'Salon başarıyla eklendi.');
    }


    public function updateSalon(Request $request, $id)
    {
        $salon = Salon::where('guid', $id)->firstOrFail();
    
        // Validasyon
        $request->validate([
            'isim' => 'required|string|max:255',
            'fakulte_id' => 'required|exists:fakulteler,id',
            'bolum_id' => 'required|exists:bolumler,id',
            'kapasite' => 'required|integer',
            'renk_kodu' => 'required|string|max:7',
        ]);
    
        // Salon güncelleme
        $salon->update([
            'isim' => $request->input('isim'),
            'fakulte_id' => $request->input('fakulte_id'),
            'bolum_id' => $request->input('bolum_id'),
            'kapasite' => $request->input('kapasite'),
            'renk_kodu' => $request->input('renk_kodu'),
        ]);
    
        return redirect()->route('sınıflar.index')->with('success', 'Salon başarıyla güncellendi.');
    }
    
    public function deleteSalon($id)
    {
        $salon = Salon::where('guid', $id)->firstOrFail();
        $salon->delete();
    
        return redirect()->route('sınıflar.index')->with('success', 'Salon başarıyla silindi.');
    }




}
