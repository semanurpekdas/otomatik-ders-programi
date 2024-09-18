<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bolum;
use Illuminate\Support\Facades\DB;

class BolumSeeder extends Seeder
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
        DB::table('bolumler')->truncate();

        // Yabancı anahtar kısıtlamalarını yeniden etkinleştir
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Bölüm kayıtlarını ekliyoruz
        Bolum::create([
            'bolum_isim' => 'Bilgisayar Mühendisliği',
            'fakulte_id' => 1,
            'uni_id' => 1,
        ]);

        Bolum::create([
            'bolum_isim' => 'Endüstri Mühendisliği',
            'fakulte_id' => 1,
            'uni_id' => 1,
        ]);
    }
}
