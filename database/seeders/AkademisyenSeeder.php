<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Akademisyen;

class AkademisyenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Akademisyen::create([
            'guid' => '3731e50b-5310-45dd-bc1b-25c4cc0dc969',
            'isim' => 'Hakan',
            'soyisim' => 'Kör',
            'kisa_kod' => 'HK',
            'cinsiyet' => 'Erkek',
            'unvan' => 'Doç. Dr.',
            'bolum_id' => 1,
            'fakulte_id' => 1,
            'email' => 'hakankor@hitit.edu.tr',
            'renk_kodu' => '#120fd7',
        ]);

        Akademisyen::create([
            'guid' => 'eb28428b-f372-4b3d-b454-ef375e32d057',
            'isim' => 'Ömer Faruk',
            'soyisim' => 'Akmeşe',
            'kisa_kod' => 'OFA',
            'cinsiyet' => 'Erkek',
            'unvan' => 'Dr. Öğr.',
            'bolum_id' => 1,
            'fakulte_id' => 1,
            'email' => 'ofarukakmese@hitit.edu.tr',
            'renk_kodu' => '#0c6d8d',
        ]);

        Akademisyen::create([
            'guid' => '2992b2d5-eade-40af-8d7f-bcfa75046723',
            'isim' => 'Akif',
            'soyisim' => 'Akgül',
            'kisa_kod' => 'AA',
            'cinsiyet' => 'Erkek',
            'unvan' => 'Prof. Dr.',
            'bolum_id' => 1,
            'fakulte_id' => 1,
            'email' => 'akifakgul@hitit.edu.tr',
            'renk_kodu' => '#17d714',
        ]);

        Akademisyen::create([
            'guid' => '6f3f771b-42f7-4683-8975-32d6a9ea2c49',
            'isim' => 'Mustafa',
            'soyisim' => 'Coşar',
            'kisa_kod' => 'MC',
            'cinsiyet' => 'Erkek',
            'unvan' => 'Dr. Öğr.',
            'bolum_id' => 1,
            'fakulte_id' => 1,
            'email' => 'mustafacosar@hitit.edu.tr',
            'renk_kodu' => '#805bb9',
        ]);

        Akademisyen::create([
            'guid' => '7d6b78f4-6e20-411c-9c2f-88d8ed802603',
            'isim' => 'Serkan',
            'soyisim' => 'Dişlitaş',
            'kisa_kod' => 'SD',
            'cinsiyet' => 'Erkek',
            'unvan' => 'Dr. Öğr.',
            'bolum_id' => 1,
            'fakulte_id' => 1,
            'email' => 'serkandislitas@hitit.edu.tr',
            'renk_kodu' => '#b9cf17',
        ]);

        Akademisyen::create([
            'guid' => 'edb4ae50-960b-4774-892c-66c967388df5',
            'isim' => 'Yusuf',
            'soyisim' => 'Alaca',
            'kisa_kod' => 'YA',
            'cinsiyet' => 'Erkek',
            'unvan' => 'Dr. Öğr.',
            'bolum_id' => 1,
            'fakulte_id' => 1,
            'email' => 'yusufalaca@hitit.edu.tr',
            'renk_kodu' => '#ac118a',
        ]);

        Akademisyen::create([
            'guid' => '43cf74e3-fefd-4f53-95ef-2eb3bfdb5984',
            'isim' => 'Emre',
            'soyisim' => 'Deniz',
            'kisa_kod' => 'ED',
            'cinsiyet' => 'Erkek',
            'unvan' => 'Dr. Öğr.',
            'bolum_id' => 1,
            'fakulte_id' => 1,
            'email' => 'emredeniz@hitit.edu.tr',
            'renk_kodu' => '#563d7c',
        ]);

        Akademisyen::create([
            'guid' => 'f5879292-49a6-4440-aa94-5987ce374cb7',
            'isim' => 'Harun Emre',
            'soyisim' => 'Kıran',
            'kisa_kod' => 'HEK',
            'cinsiyet' => 'Erkek',
            'unvan' => 'Arş. Gör.',
            'bolum_id' => 1,
            'fakulte_id' => 1,
            'email' => 'harunemrekiran@hitit.edu.tr',
            'renk_kodu' => '#610edd',
        ]);

        Akademisyen::create([
            'guid' => '694045fe-ebd5-4d54-adc2-ae6e4f642274',
            'isim' => 'Semanur',
            'soyisim' => 'Çökekoğlu',
            'kisa_kod' => 'SC',
            'cinsiyet' => 'Kadın',
            'unvan' => 'Arş. Gör.',
            'bolum_id' => 1,
            'fakulte_id' => 1,
            'email' => 'semanurcokekoglu@hitit.edu.tr',
            'renk_kodu' => '#563d7c',
        ]);

        Akademisyen::create([
            'guid' => '2a6036dc-b457-4e33-b273-27ddbba8198c',
            'isim' => 'Arzu',
            'soyisim' => 'KARAYEL',
            'kisa_kod' => 'ArzuK',
            'cinsiyet' => 'Kadın',
            'unvan' => 'Dr. Öğr.',
            'bolum_id' => 1,
            'fakulte_id' => 1,
            'email' => 'arzukarayel@gmail.com',
            'renk_kodu' => '#93ae0f',
        ]);

        Akademisyen::create([
            'guid' => '43e936fc-c66a-4bb9-929f-2170108ccac4',
            'isim' => 'Cemil',
            'soyisim' => 'ZOBAR',
            'kisa_kod' => 'CemilZ',
            'cinsiyet' => 'Erkek',
            'unvan' => 'Arş. Gör.',
            'bolum_id' => 1,
            'fakulte_id' => 1,
            'email' => 'cemil@gmail.com',
            'renk_kodu' => '#1b0b32',
        ]);

        Akademisyen::create([
            'guid' => '1e148d2a-8169-4430-b25e-482ef4cf9bc9',
            'isim' => 'Erdener',
            'soyisim' => 'ÖZÇETİN',
            'kisa_kod' => 'ErdenerÖ',
            'cinsiyet' => 'Erkek',
            'unvan' => 'Dr. Öğr.',
            'bolum_id' => 1,
            'fakulte_id' => 1,
            'email' => 'erdener@gmail.com',
            'renk_kodu' => '#563d7c',
        ]);

        Akademisyen::create([
            'guid' => '6368e6fd-6bc2-45a6-9703-f1082db59e83',
            'isim' => 'Fikriye',
            'soyisim' => 'BOY',
            'kisa_kod' => 'FikriyeB',
            'cinsiyet' => 'Kadın',
            'unvan' => 'Arş. Gör.',
            'bolum_id' => 1,
            'fakulte_id' => 1,
            'email' => 'fikriye@gmail.com',
            'renk_kodu' => '#563d7c',
        ]);

        Akademisyen::create([
            'guid' => '445822e5-5b5c-4829-ae29-bd68c8e785b5',
            'isim' => 'Mustafa',
            'soyisim' => 'BAHAR',
            'kisa_kod' => 'MustafaB',
            'cinsiyet' => 'Erkek',
            'unvan' => 'Arş. Gör.',
            'bolum_id' => 1,
            'fakulte_id' => 1,
            'email' => 'mustafabahar@gmail.com',
            'renk_kodu' => '#563d7c',
        ]);

        Akademisyen::create([
            'guid' => 'f70735e3-ccb8-44e5-9c01-76d3bbffb1cc',
            'isim' => 'Burcu',
            'soyisim' => 'ÖZAYDIN  YAKIŞTIRAN',
            'kisa_kod' => 'BurcuÖY',
            'cinsiyet' => 'Kadın',
            'unvan' => 'Dr. Öğr.',
            'bolum_id' => 1,
            'fakulte_id' => 1,
            'email' => 'burcuozaydin@gmail.com',
            'renk_kodu' => '#563d7c',
        ]);

        Akademisyen::create([
            'guid' => '39c8d300-99b0-43aa-9afa-ddea7ce01ae2',
            'isim' => 'Mehmet Ziya',
            'soyisim' => 'HOŞBAŞ',
            'kisa_kod' => 'MehmetZH',
            'cinsiyet' => 'Erkek',
            'unvan' => 'Arş. Gör.',
            'bolum_id' => 1,
            'fakulte_id' => 1,
            'email' => 'mehmetziyahosbas@gmail.com',
            'renk_kodu' => '#563d7c',
        ]);

        Akademisyen::create([
            'guid' => 'e352d806-20e5-49f3-ac53-2f04913e7b19',
            'isim' => 'Hüsnü',
            'soyisim' => 'YALDUZ',
            'kisa_kod' => 'HüsnüY',
            'cinsiyet' => 'Erkek',
            'unvan' => 'Dr. Öğr.',
            'bolum_id' => 1,
            'fakulte_id' => 1,
            'email' => 'husnuozdaydin@gmail.com',
            'renk_kodu' => '#563d7c',
        ]);

        Akademisyen::create([
            'guid' => '3e44078f-4334-471c-8932-15cea40a1e62',
            'isim' => 'Songül',
            'soyisim' => 'Demirel  Değirmenci',
            'kisa_kod' => 'SongulDD',
            'cinsiyet' => 'Kadın',
            'unvan' => 'Dr. Öğr.',
            'bolum_id' => 1,
            'fakulte_id' => 1,
            'email' => 'songulde@gmail.com',
            'renk_kodu' => '#563d7c',
        ]);
    }
}
