<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder sırasını doğru bir şekilde ayarlıyoruz
        $this->call([
            UniversitelerSeeder::class,  // İlk olarak üniversiteler eklenecek
            FakulteSeeder::class,        // Daha sonra fakülteler
            BolumSeeder::class,          // Sonra bölümler
            UserSeeder::class,           // Kullanıcılar ekleniyor
            RoleSeeder::class,           // Rolleri ekliyoruz
            UserRoleSeeder::class,       // Kullanıcı ve roller ilişkisi
            SalonSeeder::class,          // Salonlar
            AkademisyenSeeder::class,    // Akademisyenler
            DersSeeder::class,           // Son olarak dersler
        ]);
    }
}
