<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'isim' => 'Admin',
            'universite' => 1,
            'fakulte' => 1,
            'bolum' => 1,
            'dersprogramı' => 1,
            'dersler' => 1,
            'salonlar' => 1,
            'user' => 1,
            'role' => 1,
            'ayar' => 1,
            'akademisyen' => 1,
        ]);

        Role::create([
            'isim' => 'Bölüm Sorumlusu',
            'universite' => 0,
            'fakulte' => 0,
            'bolum' => 0,
            'dersprogramı' => 1,
            'dersler' => 1,
            'salonlar' => 1,
            'user' => 1,
            'role' => 0,
            'ayar' => 1,
            'akademisyen' => 1,
        ]);

        Role::create([
            'isim' => 'Fakülte Sorumlusu',
            'universite' => 0,
            'fakulte' => 0,
            'bolum' => 1,
            'dersprogramı' => 1,
            'dersler' => 1,
            'salonlar' => 1,
            'user' => 1,
            'role' => 1,
            'ayar' => 1,
            'akademisyen' => 1,
        ]);

        Role::create([
            'isim' => 'Üniversite Sorumlusu',
            'universite' => 0,
            'fakulte' => 1,
            'bolum' => 1,
            'dersprogramı' => 1,
            'dersler' => 1,
            'salonlar' => 1,
            'user' => 1,
            'role' => 1,
            'ayar' => 1,
            'akademisyen' => 1,
        ]);

        Role::create([
            'isim' => 'Admin Yardımcısı',
            'universite' => 1,
            'fakulte' => 1,
            'bolum' => 1,
            'dersprogramı' => 1,
            'dersler' => 1,
            'salonlar' => 1,
            'user' => 1,
            'role' => 1,
            'ayar' => 1,
            'akademisyen' => 1,
        ]);
    }
}
