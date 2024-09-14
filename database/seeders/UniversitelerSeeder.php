<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UniversitelerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('universiteler')->insert([
            [
                'isim' => 'Hitit Üniversitesi',
                'img_yolu' => 'storage/images/1726177859_hitit-logo.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'isim' => 'Hacettepe Üniversitesi',
                'img_yolu' => 'storage/images/1726189951_113082.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'isim' => 'Orta Doğu Teknik Üniversitesi',
                'img_yolu' => 'storage/images/1726189993_122571.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'isim' => 'Yıldız Teknik Üniversitesi',
                'img_yolu' => 'storage/images/1726190025_126982.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'isim' => 'Tokat Gaziosmanpaşa Üniversitesi',
                'img_yolu' => 'storage/images/1726190068_367245.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'isim' => 'Amasya Üniversitesi',
                'img_yolu' => 'storage/images/1726190123_102198.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
