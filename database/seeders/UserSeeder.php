<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'guid' => '097bbddc-830c-4d99-a22b-fcb0cdec2b7b',
            'isim' => 'Bilal Çağrı',
            'soyisim' => 'ALGAN',
            'email' => 'bilalcagrialgan@gmail.com',
            'telefon' => '05458733317',
            'email_verified_at' => now(),
            'password' => Hash::make('1233210099xx'), // Şifreyi burada belirtin
            'remember_token' => Str::random(60),
            'uni_id' => 1,
            'bolum_id' => 1,
            'unvan' => 'Öğrenci',
            'profilimg_path' => 'images/profiller/Qpv39QhqeO6fJYnvsiCf1YbmlCoz0J8w74KakKPS.png',
        ]);
    }
}
