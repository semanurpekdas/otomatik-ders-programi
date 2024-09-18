<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fakulte;
use Illuminate\Support\Facades\DB;

class FakulteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Yabancı anahtar kısıtlamalarını devre dışı bırak
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate işlemi
        DB::table('fakulteler')->truncate();

        // Yabancı anahtar kısıtlamalarını yeniden etkinleştir
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Fakülte kayıtlarını ekliyoruz
        Fakulte::create([
            'fakulte_isim' => 'Mühendislik Fakültesi',
            'uni_id' => 1,
        ]);

        Fakulte::create([
            'fakulte_isim' => 'Mühendislik Fakültesi',
            'uni_id' => 2,
        ]);

        Fakulte::create([
            'fakulte_isim' => 'Sağlık Bilimleri Fakültesi',
            'uni_id' => 1,
        ]);

        Fakulte::create([
            'fakulte_isim' => 'İlahiyat Fakültesi',
            'uni_id' => 1,
        ]);
    }
}
