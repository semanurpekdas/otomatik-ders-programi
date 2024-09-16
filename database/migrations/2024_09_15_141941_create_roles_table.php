<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('isim')->unique();
            $table->boolean('universite')->default(0);  // Üniversite yönetimi yetkisi
            $table->boolean('fakulte')->default(0);     // Fakülte yönetimi yetkisi
            $table->boolean('bolum')->default(0);       // Bölüm yönetimi yetkisi
            $table->boolean('dersprogramı')->default(0);// Ders programı yönetimi yetkisi
            $table->boolean('dersler')->default(0);     // Dersler yönetimi yetkisi
            $table->boolean('salonlar')->default(0);    // Salonlar yönetimi yetkisi
            $table->boolean('user')->default(0);        // Kullanıcı yönetimi yetkisi
            $table->boolean('role')->default(0);        // Rol yönetimi yetkisi
            $table->boolean('ayar')->default(0);        // Ayarlar yönetimi yetkisi
            $table->boolean('akademisyen')->default(0); // Akademisyen yönetimi yetkisi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
