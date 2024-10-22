<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Universite; // Universiteler tablosu için model
use App\Models\Fakulte; // Universiteler tablosu için model
use App\Models\Bolum;
use Illuminate\Support\Facades\Storage; // Dosya depolama işlemleri için
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\UserRole;

class AdminController extends Controller
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

    public function university(Request $request)
    {
        // Query oluşturma
        $query = \App\Models\Universite::query();
    
        // Üniversite adına göre filtreleme
        if ($request->has('search') && !empty($request->input('search'))) {
            $query->where('isim', 'like', '%' . $request->input('search') . '%');
        }
    
        // Sıralama işlemi (A'dan Z'ye veya Z'den A'ya)
        if ($request->has('order') && in_array($request->input('order'), ['asc', 'desc'])) {
            $query->orderBy('isim', $request->input('order'));
        }
    
        // Filtrelenmiş sonuçları sayfalama ile getirme
        $universiteler = $query->paginate(5)->appends([
            'search' => $request->input('search'),
            'order' => $request->input('order'),
        ]); // Sayfa başına 5 sonuç örnek
        
        return view('admin.universiteler', compact('universiteler'));
    }

    public function addUniversity(Request $request)
    {
        // Validasyon
        $request->validate([
            'universite_adi' => 'required|string|max:255',
            'universite_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Üniversite adını düzenleme (Türkçe karakterlerle ilk harf büyük yap)
        $universiteAdi = mb_convert_case($request->input('universite_adi'), MB_CASE_TITLE, "UTF-8");
    
        // Dosyayı yükleme
        if ($request->hasFile('universite_logo')) {
            $file = $request->file('universite_logo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('images', $fileName, 'public'); // 'public' diskini kullan
    
            // Veritabanına kayıt
            Universite::create([
                'isim' => $universiteAdi,
                'img_yolu' => $filePath, // Dosyanın yolu sadece 'images/dosya_adı'
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            return redirect()->back()->with('success', 'Üniversite başarıyla eklendi!');
        }
    
        return redirect()->back()->with('error', 'Bir hata oluştu, lütfen tekrar deneyin.');
    }
    
    public function deleteUniversity($id)
    {
        // İlgili üniversiteyi bul ve sil
        $universite = \App\Models\Universite::findOrFail($id);
        
        // İlgili resmi de silelim
        if (Storage::disk('public')->exists(str_replace('storage/', '', $universite->img_yolu))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $universite->img_yolu));
        }

        // Üniversite kaydını sil
        $universite->delete();

        return redirect()->back()->with('success', 'Üniversite başarıyla silindi.'); 
    }

    public function updateUniversity(Request $request, $id)
    {
        // Validasyon
        $request->validate([
            'universite_adi' => 'required|string|max:255',
            'universite_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // İlgili üniversiteyi bul
        $universite = \App\Models\Universite::findOrFail($id);

        // Eğer yeni bir logo yüklendiyse
        if ($request->hasFile('universite_logo')) {
            // Eski logoyu sil
            if (Storage::disk('public')->exists(str_replace('storage/', '', $universite->img_yolu))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $universite->img_yolu));
            }

            // Yeni logoyu kaydet
            $file = $request->file('universite_logo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('images', $fileName, 'public');

            // Yeni logo yolunu güncelle
            $universite->img_yolu = $filePath;
        }

        // Üniversite ismini güncelle
        $universite->isim = $request->input('universite_adi');

        // Güncellenmiş verileri kaydet
        $universite->updated_at = now();
        $universite->save();

        return redirect()->back()->with('success', 'Üniversite başarıyla güncellendi.');
    } 



    // Fakülteler
    public function fakulteler(Request $request)
    {
        // Fakülteleri ve ilişkili üniversite bilgilerini sorguluyoruz
        $query = Fakulte::with('universite');
    
        // Fakülte adına göre arama
        if ($request->filled('fakulte_adi')) {
            $query->where('fakulte_isim', 'LIKE', '%' . $request->input('fakulte_adi') . '%');
        }
    
        // Üniversite adına göre arama
        if ($request->filled('universite_adi')) {
            $query->whereHas('universite', function ($q) use ($request) {
                $q->where('isim', 'LIKE', '%' . $request->input('universite_adi') . '%');
            });
        }
    
        // Fakülte adına göre sıralama
        if ($request->filled('fakulte_order')) {
            $query->orderBy('fakulte_isim', $request->input('fakulte_order'));
        }
    
        // Üniversite adına göre sıralama
        if ($request->filled('universite_order')) {
            $query->whereHas('universite', function ($q) use ($request) {
                $q->orderBy('isim', $request->input('universite_order'));
            });
        }
    
        // Sonuçları paginate ediyoruz, 5 kayıt gösterecek şekilde
        $fakulteler = $query->paginate(5);
    
        // Üniversitelerin sadece id ve isimlerini alıyoruz
        $universiteler = Universite::select('id', 'isim')->get();
    
        // Verileri view'e gönderiyoruz
        return view('admin.fakulteler', compact('fakulteler', 'universiteler'));
    }
    
    public function addFakulte(Request $request)
    {
        // Validasyon
        $request->validate([
            'fakulte_adi' => 'required|string|max:255',
            'universite_adi' => 'required|string'
        ]);

        // Fakülte adını düzenleme (Türkçe karakterlerle ilk harf büyük yap)
        $fakulteAdi = mb_convert_case($request->input('fakulte_adi'), MB_CASE_TITLE, "UTF-8");

        // Üniversite adını düzenleme (Türkçe karakterlerle ilk harf büyük yap)
        $universiteAdi = mb_convert_case($request->input('universite_adi'), MB_CASE_TITLE, "UTF-8");

        // Üniversiteyi veritabanından bulma
        $universite = Universite::where('isim', $universiteAdi)->first();

        if (!$universite) {
            // Üniversite bulunamazsa hata döndür
            return redirect()->back()->with('error', 'Bu isimde bir üniversite bulunamadı.');
        }

        // Fakülteyi veritabanına kaydetme
        Fakulte::create([
            'fakulte_isim' => $fakulteAdi,
            'uni_id' => $universite->id
        ]);

        return redirect()->back()->with('success', 'Fakülte başarıyla eklendi!');
    }

    public function updateFakulte(Request $request, $id)
    {
        // Validasyon
        $request->validate([
            'fakulte_adi' => 'required|string|max:255',
            'universite_adi' => 'required|string'
        ]);

        // Fakülte adını düzenleme
        $fakulteAdi = mb_convert_case($request->input('fakulte_adi'), MB_CASE_TITLE, "UTF-8");

        // Üniversiteyi bulma
        $universiteAdi = mb_convert_case($request->input('universite_adi'), MB_CASE_TITLE, "UTF-8");
        $universite = Universite::where('isim', $universiteAdi)->first();

        if (!$universite) {
            return redirect()->back()->with('error', 'Üniversite bulunamadı.');
        }

        // Fakülteyi güncelleme
        $fakulte = Fakulte::findOrFail($id);
        $fakulte->update([
            'fakulte_isim' => $fakulteAdi,
            'uni_id' => $universite->id
        ]);

        return redirect()->back()->with('success', 'Fakülte başarıyla güncellendi.');
    }

    public function deleteFakulte($id)
    {
        $fakulte = Fakulte::findOrFail($id);
        $fakulte->delete();

        return redirect()->back()->with('success', 'Fakülte başarıyla silindi.');
    }



    //Bölümler
    public function bolumler(Request $request)
    {
        // Sorguyu oluşturuyoruz
        $query = \App\Models\Bolum::with('fakulte.universite');
        
        // Bölüm adına göre arama
        if ($request->filled('bolum_adi')) {
            $query->where('bolum_isim', 'LIKE', '%' . mb_convert_case($request->input('bolum_adi'), MB_CASE_TITLE, "UTF-8") . '%');
        }
        
        // Fakülte adına göre arama
        if ($request->filled('fakulte_adi')) {
            $query->whereHas('fakulte', function ($q) use ($request) {
                $q->where('fakulte_isim', 'LIKE', '%' . mb_convert_case($request->input('fakulte_adi'), MB_CASE_TITLE, "UTF-8") . '%');
            });
        }
        
        // Üniversite adına göre arama
        if ($request->filled('universite_adi')) {
            $query->whereHas('fakulte.universite', function ($q) use ($request) {
                $q->where('isim', 'LIKE', '%' . mb_convert_case($request->input('universite_adi'), MB_CASE_TITLE, "UTF-8") . '%');
            });
        }
        
        // Bölüm ismine göre sıralama
        if ($request->filled('fakulte_order')) {
            $query->orderBy('bolum_isim', $request->input('fakulte_order'));
        }
        
        // Sonuçları paginate ediyoruz (sayfa başına 5 kayıt)
        $bolumler = $query->paginate(5)->appends([
            'bolum_adi' => $request->input('bolum_adi'),
            'fakulte_adi' => $request->input('fakulte_adi'),
            'universite_adi' => $request->input('universite_adi'),
            'fakulte_order' => $request->input('fakulte_order')
        ]);
    
        // Üniversitelerin ve fakültelerin listesini hazırlıyoruz
        $fakulteler = \App\Models\Fakulte::select('fakulte_isim')->distinct()->get(); // Tekil fakülte isimleri
        $fakulteler2 = \App\Models\Fakulte::with('universite')->get(); // Fakülte ve üniversite isimlerini birlikte gönderiyoruz
        $universiteler = \App\Models\Universite::select('isim')->distinct()->get(); // Tekil üniversite isimleri
    
        return view('admin.bolumler', compact('bolumler', 'fakulteler', 'fakulteler2', 'universiteler'));
    }
    
    public function addBolum(Request $request)
    {
        // Validasyon
        $request->validate([
            'universite_adi' => 'required|string|max:255',
            'fakulte_adi' => 'required|string|max:255',
            'bolum_adi' => 'required|string|max:255',
        ]);

        // Üniversite adını düzgün şekilde düzenleyelim
        $universiteAdi = mb_convert_case($request->input('universite_adi'), MB_CASE_TITLE, "UTF-8");
        $fakulteAdi = mb_convert_case($request->input('fakulte_adi'), MB_CASE_TITLE, "UTF-8");
        $bolumAdi = mb_convert_case($request->input('bolum_adi'), MB_CASE_TITLE, "UTF-8");

        // Üniversiteyi bulma
        $universite = \App\Models\Universite::where('isim', $universiteAdi)->first();
        if (!$universite) {
            return redirect()->back()->with('error', 'Üniversite bulunamadı.');
        }

        // Fakülteyi bulma
        $fakulte = \App\Models\Fakulte::where('fakulte_isim', $fakulteAdi)
                                    ->where('uni_id', $universite->id)
                                    ->first();
        if (!$fakulte) {
            return redirect()->back()->with('error', 'Bu üniversiteye ait fakülte bulunamadı.');
        }

        // Bölümü ekleme
        \App\Models\Bolum::create([
            'bolum_isim' => $bolumAdi,
            'fakulte_id' => $fakulte->id,
            'uni_id' => $universite->id, 
        ]);

        return redirect()->back()->with('success', 'Bölüm başarıyla eklendi!');
    }

    public function updateBolum(Request $request, $id)
    {
        // Validasyon
        $request->validate([
            'universite_adi' => 'required|string|max:255',
            'fakulte_adi' => 'required|string|max:255',
            'bolum_adi' => 'required|string|max:255',
        ]);

        // Üniversite ve fakülte adlarını düzgün formatta düzenleme
        $universiteAdi = mb_convert_case($request->input('universite_adi'), MB_CASE_TITLE, "UTF-8");
        $fakulteAdi = mb_convert_case($request->input('fakulte_adi'), MB_CASE_TITLE, "UTF-8");
        $bolumAdi = mb_convert_case($request->input('bolum_adi'), MB_CASE_TITLE, "UTF-8");

        // Üniversiteyi bulma
        $universite = \App\Models\Universite::where('isim', $universiteAdi)->first();
        if (!$universite) {
            return redirect()->back()->with('error', 'Üniversite bulunamadı.');
        }

        // Fakülteyi bulma
        $fakulte = \App\Models\Fakulte::where('fakulte_isim', $fakulteAdi)
                                    ->where('uni_id', $universite->id)
                                    ->first();
        if (!$fakulte) {
            return redirect()->back()->with('error', 'Bu üniversiteye ait fakülte bulunamadı.');
        }

        // Bölümü güncelleme
        $bolum = \App\Models\Bolum::findOrFail($id);
        $bolum->update([
            'bolum_isim' => $bolumAdi,
            'fakulte_id' => $fakulte->id,
            'uni_id' => $universite->id,
        ]);

        return redirect()->back()->with('success', 'Bölüm başarıyla güncellendi!');
    }

    public function deleteBolum($id)
    {
        $bolum = \App\Models\Bolum::findOrFail($id);
        $bolum->delete();

        return redirect()->back()->with('success', 'Bölüm başarıyla silindi!');
    }


    //Roller
    public function roller(Request $request)
    {
        // Rol adı ve yetki filtreleme işlemleri
        $query = Role::query();
    
        // Rol adına göre filtreleme
        if ($request->has('rol_adi') && $request->rol_adi != '') {
            $query->where('isim', 'like', '%' . $request->rol_adi . '%');
        }
    
        // Yetkilere göre filtreleme
        $permissions = ['universite', 'fakulte', 'bolum', 'dersprogramı', 'dersler', 'salonlar', 'user', 'role', 'ayar', 'akademisyen'];
        foreach ($permissions as $permission) {
            if ($request->has($permission)) {
                $query->where($permission, 1);
            }
        }
    
        // 5 kayıt olacak şekilde pagination yapıyoruz
        $roles = $query->paginate(5);
    
        // Rolleri 'admin.roller' blade sayfasına gönderiyoruz
        return view('admin.roller', compact('roles'));
    }
    
    public function addRole(Request $request)
    {
        // Yeni rolü oluşturuyoruz
        $role = new Role();
        $role->isim = $request->input('rol_adi');
        
        // Yetkiler kontrol ediliyor ve atanıyor
        $role->universite = $request->has('universite') ? 1 : 0;
        $role->fakulte = $request->has('fakulte') ? 1 : 0;
        $role->bolum = $request->has('bolum') ? 1 : 0;
        $role->dersprogramı = $request->has('dersprogramı') ? 1 : 0;
        $role->dersler = $request->has('dersler') ? 1 : 0;
        $role->salonlar = $request->has('salonlar') ? 1 : 0;
        $role->user = $request->has('user') ? 1 : 0;
        $role->role = $request->has('role') ? 1 : 0;
        $role->ayar = $request->has('ayar') ? 1 : 0;
        $role->akademisyen = $request->has('akademisyen') ? 1 : 0;

        // Rolü kaydediyoruz
        $role->save();

        // Başarıyla ekleme sonrası geri dönüyoruz
        return redirect()->route('admin.roller')->with('success', 'Rol başarıyla eklendi!');
    }

    public function updateRole(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->isim = $request->input('rol_adi');
        
        // Yetkileri güncelleme
        $role->universite = $request->has('universite') ? 1 : 0;
        $role->fakulte = $request->has('fakulte') ? 1 : 0;
        $role->bolum = $request->has('bolum') ? 1 : 0;
        $role->dersprogramı = $request->has('dersprogramı') ? 1 : 0;
        $role->dersler = $request->has('dersler') ? 1 : 0;
        $role->salonlar = $request->has('salonlar') ? 1 : 0;
        $role->user = $request->has('user') ? 1 : 0;
        $role->role = $request->has('role') ? 1 : 0;
        $role->ayar = $request->has('ayar') ? 1 : 0;
        $role->akademisyen = $request->has('akademisyen') ? 1 : 0;

        $role->save();

        return redirect()->route('admin.roller')->with('success', 'Rol başarıyla güncellendi!');
    }

    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.roller')->with('success', 'Rol başarıyla silindi!');
    }

    public function userRole(Request $request)
    {
        // Rolleri çekiyoruz
        $roles = \App\Models\Role::all();
    
        // Seçilen role göre kullanıcıları filtreliyoruz
        $selectedRoleId = $request->query('role_id', $roles->first()->id); // Varsayılan olarak ilk rol seçiliyor
        $kullanıcılar = \App\Models\User::whereHas('roles', function ($query) use ($selectedRoleId) {
            $query->where('roles.id', $selectedRoleId);
        })->with('universite', 'bolum')->paginate(7);
    
        return view('admin.userRole', compact('roles', 'kullanıcılar', 'selectedRoleId'));
    }
    



    // Kullanıcılar
    public function users(Request $request)
    {
        // Kullanıcı sorgusunu oluşturuyoruz
        $query = \App\Models\User::with('universite', 'bolum');
    
        // İsim Soyisim arama
        if ($request->filled('isim')) {
            $query->whereRaw('CONCAT(isim, " ", soyisim) LIKE ?', ['%' . mb_convert_case($request->input('isim'), MB_CASE_TITLE, "UTF-8") . '%']);
        }
    
        // E-mail arama
        if ($request->filled('email')) {
            $query->where('email', 'LIKE', '%' . $request->input('email') . '%');
        }
    
        // Üniversite adına göre arama
        if ($request->filled('universite')) {
            $query->whereHas('universite', function ($q) use ($request) {
                $q->where('isim', 'LIKE', '%' . mb_convert_case($request->input('universite'), MB_CASE_TITLE, "UTF-8") . '%');
            });
        }
    
        // Bölüm adına göre arama
        if ($request->filled('bolum')) {
            $query->whereHas('bolum', function ($q) use ($request) {
                $q->where('bolum_isim', 'LIKE', '%' . mb_convert_case($request->input('bolum'), MB_CASE_TITLE, "UTF-8") . '%');
            });
        }
    
        // Unvan'a göre arama
        if ($request->filled('unvan')) {
            $query->where('unvan', $request->input('unvan'));
        }
    
        // Sonuçları paginate ediyoruz (sayfa başına 5 kayıt)
        $kullanıcılar = $query->paginate(5)->appends($request->all());
    
        // Benzersiz üniversite ve bölüm isimlerini alıyoruz
        $universiteler = \App\Models\Universite::select('isim')->distinct()->get();
        $bolumler = \App\Models\Bolum::select('bolum_isim')->distinct()->get();
    
        return view('admin.users', compact('kullanıcılar', 'universiteler', 'bolumler'));
    }

    public function userscreate()
    {
        // Rolleri ve üniversiteleri çekiyoruz
        $roles = \App\Models\Role::all();
        $universiteler = \App\Models\Universite::select('id', 'isim')->get();
        $bolumler = \App\Models\Bolum::with('universite')->get();
    
        return view('admin.userscreate', compact('roles', 'universiteler', 'bolumler'));
    }

    public function adduser(Request $request)
    {
        // Oturum açmış olan admin kullanıcısını geçici olarak alıyoruz
        $currentUser = Auth::user();
    
        // Validasyon işlemi
        $this->validate($request, [
            'isim' => ['required', 'string', 'max:255'],
            'soyisim' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefon' => ['required', 'string', 'max:15'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'universite_adi' => ['required', 'string'],
            'bolum' => ['required', 'string'],
            'unvan' => ['required', 'string'],
        ]);
    
        // Üniversiteyi bulma
        $universiteAdi = mb_convert_case($request->input('universite_adi'), MB_CASE_TITLE, "UTF-8");
        $universite = Universite::where('isim', $universiteAdi)->first();
    
        if (!$universite) {
            return redirect()->back()->withInput()->withErrors(['universite_adi' => 'Üniversite bulunamadı.']);
        }
    
        // Bölümü bulma
        $bolumAdi = mb_convert_case($request->input('bolum'), MB_CASE_TITLE, "UTF-8");
        $bolum = Bolum::where('bolum_isim', $bolumAdi)->where('uni_id', $universite->id)->first();
    
        if (!$bolum) {
            return redirect()->back()->withInput()->withErrors(['bolum' => 'Üniversitede bölüm bulunamadı.']);
        }
    
        // Profil resmi yükleme
        $profilimgPath = null;
        if ($request->hasFile('profilimg')) {
            $profilimg = $request->file('profilimg');
            $profilimgPath = $profilimg->storeAs('images/profiller', time() . '_' . $profilimg->getClientOriginalName(), 'public');
        }
    
        // Kullanıcı oluşturma
        $user = User::create([
            'guid' => Str::uuid(),
            'isim' => $request->input('isim'),
            'soyisim' => $request->input('soyisim'),
            'email' => $request->input('email'),
            'telefon' => $request->input('telefon'),
            'password' => Hash::make($request->input('password')),
            'uni_id' => $universite->id,
            'bolum_id' => $bolum->id,
            'unvan' => $request->input('unvan'),
            'profilimg_path' => $profilimgPath,
        ]);
    
        // Kullanıcının emailini doğrulanmış olarak işaretliyoruz
        $user->markEmailAsVerified();
    
        // Seçilen roller varsa user_role tablosuna kaydet
        if ($request->has('roles')) {
            foreach ($request->input('roles') as $role_id) {
                \App\Models\UserRole::create([
                    'user_id' => $user->id,
                    'role_id' => $role_id,
                ]);
            }
        }
    
        // Yeni kullanıcıyı oluşturduktan sonra oturumu kapat
        Auth::logout();
    
        // Eski admin kullanıcısı ile tekrar oturum aç
        Auth::login($currentUser);
    
        return redirect()->route('admin.users')->with('success', 'Kullanıcı başarıyla oluşturuldu ve oturum admin ile devam ediyor.');
    }

    public function editUser($guid)
    {
        // Kullanıcıyı buluyoruz
        $kullanici = User::where('guid', $guid)->with('roles')->firstOrFail();

        // Rolleri ve üniversiteleri alıyoruz
        $roles = \App\Models\Role::all();
        $universiteler = \App\Models\Universite::select('id', 'isim')->get();
        $bolumler = \App\Models\Bolum::with('universite')->get();

        return view('admin.usersedit', compact('kullanici', 'roles', 'universiteler', 'bolumler'));
    }

    public function updateUser(Request $request, $guid)
    {
        // Kullanıcıyı buluyoruz
        $user = User::where('guid', $guid)->firstOrFail();

        // Validasyon işlemi
        $this->validate($request, [
            'isim' => ['required', 'string', 'max:255'],
            'soyisim' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id], // Kendi e-posta adresini doğrula
            'telefon' => ['required', 'string', 'max:15'],
            'universite_adi' => ['required', 'string'],
            'bolum' => ['required', 'string'],
            'unvan' => ['required', 'string'],
        ]);

        // Üniversiteyi bulma
        $universiteAdi = mb_convert_case($request->input('universite_adi'), MB_CASE_TITLE, "UTF-8");
        $universite = Universite::where('isim', $universiteAdi)->first();

        if (!$universite) {
            return redirect()->back()->withInput()->withErrors(['universite_adi' => 'Üniversite bulunamadı.']);
        }

        // Bölümü bulma
        $bolumAdi = mb_convert_case($request->input('bolum'), MB_CASE_TITLE, "UTF-8");
        $bolum = Bolum::where('bolum_isim', $bolumAdi)->where('uni_id', $universite->id)->first();

        if (!$bolum) {
            return redirect()->back()->withInput()->withErrors(['bolum' => 'Üniversitede bölüm bulunamadı.']);
        }

        // Profil resmi yükleme
        if ($request->hasFile('profilimg')) {
            // Eski resmi sil
            if ($user->profilimg_path) {
                Storage::disk('public')->delete($user->profilimg_path);
            }

            // Yeni resmi yükle
            $profilimg = $request->file('profilimg');
            $profilimgPath = $profilimg->storeAs('images/profiller', time() . '_' . $profilimg->getClientOriginalName(), 'public');
            $user->profilimg_path = $profilimgPath;
        }

        // Kullanıcıyı güncelle
        $user->update([
            'isim' => $request->input('isim'),
            'soyisim' => $request->input('soyisim'),
            'email' => $request->input('email'),
            'telefon' => $request->input('telefon'),
            'uni_id' => $universite->id,
            'bolum_id' => $bolum->id,
            'unvan' => $request->input('unvan'),
        ]);

        // Roller güncelleniyor
        if ($request->has('roles')) {
            // Mevcut roller siliniyor
            \App\Models\UserRole::where('user_id', $user->id)->delete();

            // Yeni roller ekleniyor
            foreach ($request->input('roles') as $role_id) {
                \App\Models\UserRole::create([
                    'user_id' => $user->id,
                    'role_id' => $role_id,
                ]);
            }
        }

        return redirect()->route('admin.users')->with('success', 'Kullanıcı başarıyla güncellendi.');
    }

    public function deleteUser($guid)
    {
        // Kullanıcıyı bul
        $user = User::where('guid', $guid)->first();

        // Eğer kullanıcı bulunamazsa hata dön
        if (!$user) {
            return redirect()->route('admin.users')->with('error', 'Kullanıcı bulunamadı.');
        }

        // Kullanıcının rol ilişkilerini (user_role tablosu) sil
        $user->roles()->detach();

        // Kullanıcıyı sil
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Kullanıcı başarıyla silindi.');
    }


    
}
 