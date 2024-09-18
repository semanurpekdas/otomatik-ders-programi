<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Salon;
use Illuminate\Support\Str;

class SalonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Salon::create([
            'guid' => '9020e160-6a25-4579-9f88-c67751ec0ec5',
            'isim' => '207',
            'fakulte_id' => 1,
            'bolum_id' => 1,
            'kapasite' => 50,
            'renk_kodu' => '#6930c0',
        ]);

        Salon::create([
            'guid' => 'c78451ab-a741-4ae4-9dc0-dcb71a0ba111',
            'isim' => '206',
            'fakulte_id' => 1,
            'bolum_id' => 1,
            'kapasite' => 70,
            'renk_kodu' => '#14b361',
        ]);

        Salon::create([
            'guid' => '8a77aeed-37d5-4910-949e-a1be321cae25',
            'isim' => 'İlahiyat Lab 1',
            'fakulte_id' => 4,
            'bolum_id' => 1,
            'kapasite' => 40,
            'renk_kodu' => '#d1772e',
        ]);

        Salon::create([
            'guid' => '8343b867-3ca1-4bb2-8d0b-7cfd57557318',
            'isim' => 'İlahiyat Lab 2',
            'fakulte_id' => 4,
            'bolum_id' => 1,
            'kapasite' => 40,
            'renk_kodu' => '#00e1ff',
        ]);
    }
}
