<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Universite; // Universiteler tablosu için model
use App\Models\Fakulte; // Universiteler tablosu için model
use Illuminate\Support\Facades\Storage; // Dosya depolama işlemleri için

class AdminController extends Controller
{
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
        
        return view('main.universiteler', compact('universiteler'));
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
            $universite->img_yolu = 'storage/' . $filePath;
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
        return view('main.fakulteler', compact('fakulteler', 'universiteler'));
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






}
