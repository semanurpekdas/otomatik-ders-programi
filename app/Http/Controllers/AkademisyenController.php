<?php

namespace App\Http\Controllers;

use App\Models\Akademisyen;
use App\Models\Bolum;
use App\Models\Fakulte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AkademisyenController extends Controller
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
        // Kullanıcının bölümü ve fakültesi
        $bolum = Bolum::find($this->user->bolum_id);
        $fakulte = $bolum ? Fakulte::find($bolum->fakulte_id) : null;
    
        // Akademisyenleri bölüme, isme ve e-postaya göre filtreleme
        $query = Akademisyen::where('fakulte_id', $fakulte->id);
    
        // Bölüme göre filtreleme
        if ($request->filled('bolum_id')) {
            $query->where('bolum_id', $request->input('bolum_id'));
        }
    
        // İsim soyisim filtreleme
        if ($request->filled('isim')) {
            $query->where(function($q) use ($request) {
                $q->where('isim', 'LIKE', '%' . $request->input('isim') . '%')
                  ->orWhere('soyisim', 'LIKE', '%' . $request->input('isim') . '%');
            });
        }
    
        // E-posta filtreleme
        if ($request->filled('email')) {
            $query->where('email', 'LIKE', '%' . $request->input('email') . '%');
        }
    
        // Akademisyenleri sayfalama ile getir
        $akademisyenler = $query->paginate(10);
    
        // Kullanıcının üniversitesindeki tüm bölümleri al
        $bolumler = Bolum::where('uni_id', $this->user->uni_id)->get();
    
        return view('main.akademisyenler', compact('bolum', 'fakulte', 'akademisyenler', 'bolumler'));
    }
    

    public function createAkademisyen(Request $request)
    {
        $bolum = Bolum::find($this->user->bolum_id);

        // Form verilerinin doğrulanması
        $request->validate([
            'isim' => 'required|string|max:255',
            'soyisim' => 'required|string|max:255',
            'kisa_kod' => 'required|string|max:10',
            'cinsiyet' => 'required',
            'unvan' => 'required|string',
            'email' => 'required|email|unique:akademisyenler',
            'renk_kodu' => 'required|string|max:7',
        ]);

        // Yeni akademisyen oluşturulması
        Akademisyen::create([
            'guid' => (string) \Illuminate\Support\Str::uuid(),
            'isim' => $request->input('isim'),
            'soyisim' => $request->input('soyisim'),
            'kisa_kod' => $request->input('kisa_kod'),
            'cinsiyet' => $request->input('cinsiyet'),
            'unvan' => $request->input('unvan'),
            'bolum_id' => $this->user->bolum_id, // Kullanıcının bölümü
            'fakulte_id' => $bolum->fakulte_id, // Kullanıcının fakültesi
            'email' => $request->input('email'),
            'renk_kodu' => $request->input('renk_kodu'),
        ]);

        return redirect()->back()->with('success', 'Akademisyen başarıyla eklendi.');
    }

    public function updateAkademisyen(Request $request, $guid)
    {
        $akademisyen = Akademisyen::where('guid', $guid)->firstOrFail();

        $request->validate([
            'isim' => 'required|string|max:255',
            'soyisim' => 'required|string|max:255',
            'kisa_kod' => 'required|string|max:10',
            'cinsiyet' => 'required',
            'unvan' => 'required|string',
            'email' => 'required|email|unique:akademisyenler,email,' . $akademisyen->id, // Email unique ama bu akademisyeni hariç tutuyoruz
            'renk_kodu' => 'required|string|max:7',
        ]);

        // Akademisyeni güncelle
        $akademisyen->update([
            'isim' => $request->input('isim'),
            'soyisim' => $request->input('soyisim'),
            'kisa_kod' => $request->input('kisa_kod'),
            'cinsiyet' => $request->input('cinsiyet'),
            'unvan' => $request->input('unvan'),
            'email' => $request->input('email'),
            'renk_kodu' => $request->input('renk_kodu'),
        ]);

        return redirect()->back()->with('success', 'Akademisyen başarıyla güncellendi.');
    }

    public function deleteAkademisyen($guid)
    {
        $akademisyen = Akademisyen::where('guid', $guid)->firstOrFail();
        $akademisyen->delete();

        return redirect()->back()->with('success', 'Akademisyen başarıyla silindi.');
    }


}
