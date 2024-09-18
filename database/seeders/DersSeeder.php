<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DersSeeder extends Seeder
{
    public function run()
    {
        $dersler = [
            ['Fizik II', 'Fizik II', 'Bahar', 4, 2, 1, 50, 0, 1, 10, '#d7bdff'],
            ['Matematik II', 'mat2', 'Bahar', 4, 2, 1, 50, 0, 1, 11, '#563d7c'],
            ['Yapısal Programlama', 'YapısalP', 'Bahar', 5, 2, 1, 30, 0, 1, 7, '#563d7c'],
            ['Kariyer Planlama', 'KP', 'Bahar', 1, 1, 1, 20, 0, 1, 12, '#563d7c'],
            ['Atatürk İlkeleri ve İnkılap Tarihi II', 'İnkılap2', 'Bahar', 2, 1, 1, 30, 0, 1, 13, '#563d7c'],
            ['Yabancı Dil II', 'YabanciDil', 'Bahar', 2, 1, 1, 30, 0, 1, 14, '#563d7c'],
            ['Türk Dili II', 'TD2', 'Bahar', 2, 1, 1, 30, 0, 1, 15, '#563d7c'],
            ['Elektrik Devreleri', 'ED', 'Bahar', 5, 2, 1, 30, 0, 1, 16, '#563d7c'],
            ['Web Programlama', 'WebP', 'Bahar', 3, 1, 2, 20, 0, 1, 1, '#563d7c'],
            ['Veri Yapıları ve Algoritmalar', 'Veri Yapıları', 'Bahar', 4, 2, 2, 30, 0, 1, 2, '#563d7c'],
            ['İş Sağlığı ve Güvenliği II', 'İSG2', 'Bahar', 2, 1, 2, 20, 0, 1, 6, '#563d7c'],
            ['Ayrık İşlemsel Yapılar', 'Ayrık İ', 'Bahar', 3, 1, 2, 30, 0, 1, 7, '#563d7c'],
            ['Elektronik Devreler', 'ElektronikD', 'Bahar', 5, 2, 2, 30, 0, 1, 17, '#563d7c'],
            ['Bilgisayar Organizasyonu', 'BilgisayarOrg', 'Bahar', 3, 1, 2, 30, 0, 1, 4, '#563d7c'],
            ['Yönetim Bilimi', 'YönetimB', 'Bahar', 2, 1, 2, 30, 0, 1, 18, '#563d7c'],
            ['Mikrodenetleyiciler', 'Mikro', 'Bahar', 5, 2, 3, 30, 0, 1, 5, '#563d7c'],
            ['Sayısal Analiz', 'Sayısal', 'Bahar', 3, 1, 3, 30, 0, 1, 6, '#563d7c'],
            ['Makine Öğrenmesi', 'MakineÖ', 'Bahar', 3, 1, 3, 30, 1, 1, 2, '#563d7c'],
            ['Graf Teorisi', 'GrafT', 'Bahar', 3, 1, 3, 30, 1, 1, 6, '#563d7c'],
            ['Sinyaller ve Sistemler', 'Sinyaller', 'Bahar', 3, 1, 3, 30, 0, 1, 3, '#563d7c'],
            ['Biçimsel Diller ve Soyut Makinalar', 'Bicimsel', 'Bahar', 3, 1, 3, 30, 0, 1, 7, '#563d7c'],
            ['Veritabanı Uygulamaları', 'VT', 'Bahar', 4, 2, 3, 30, 0, 1, 1, '#563d7c'],
            ['Endüstriyel Robotlar', 'Endüstriyel', 'Bahar', 3, 1, 4, 30, 1, 1, 5, '#563d7c'],
            ['Bulut Çözümleri', 'Bulut', 'Bahar', 3, 1, 4, 30, 1, 1, 3, '#563d7c'],
            ['Bilgisayar Ağları', 'PCAğ', 'Bahar', 3, 1, 4, 30, 0, 1, 4, '#563d7c'],
            ['Bilgisayar ve Ağ Güvenliği', 'Ag Guvenligi', 'Bahar', 3, 1, 4, 30, 1, 1, 6, '#563d7c'],
            ['Genetik Algoritmalar ve Programlama', 'Genetik', 'Bahar', 3, 1, 4, 30, 1, 1, 6, '#563d7c'],
            ['Sistem Programlama', 'SistemP', 'Bahar', 3, 1, 4, 30, 0, 1, 7, '#563d7c'],
        ];

        foreach ($dersler as $ders) {
            DB::table('dersler')->insert([
                'ders_adi' => $ders[0],
                'kisa_isim' => $ders[1],
                'donem' => $ders[2],
                'ders_sayisi' => $ders[3],
                'ders_parcasi' => $ders[4],
                'sinif' => $ders[5],
                'alan_kisi_sayisi' => $ders[6],
                'secmeli_durumu' => $ders[7],
                'bolum_id' => $ders[8],
                'hoca_id' => $ders[9],
                'renk_kodu' => $ders[10],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
