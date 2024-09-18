<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User ID'si 1 olan kullanıcıya Role ID'si 1 olan rol atanıyor
        UserRole::create([
            'user_id' => 1,
            'role_id' => 1,
        ]);
    }
}
