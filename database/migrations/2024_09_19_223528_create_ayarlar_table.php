<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAyarlarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ayarlar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bolum_id')->unique(); // Zorunlu ve benzersiz olacak
            $table->integer('gunluk_ders_saati')->nullable(); // Günlük ders saati, int tipinde
            $table->json('haftanin_gunleri')->nullable(); // Haftanın günleri, liste (JSON) formatında
            $table->string('yıl_donem')->nullable(); // Yıl ve dönem, string
            $table->integer('ara_saati')->nullable(); // Ara saati, int tipinde
            $table->string('renklendirme_secim')->nullable(); // Renklendirme seçimi, string formatında
            $table->boolean('online_ders_sinifa_yerlestirme')->default(0); // Online ders yerleştirme, bool tipinde (0 veya 1)
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
        Schema::dropIfExists('ayarlar');
    }
}
