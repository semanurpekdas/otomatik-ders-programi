<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDersProgramiSartlariTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ders_programi_sartlari', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bolum_id'); // Bölüm ID
            $table->boolean('sinif_cakismamasi')->default(0); // Sınıf Çakışması (0 veya 1)
            $table->boolean('akademisyen_cakismamasi')->default(0); // Akademisyen Çakışması (0 veya 1)
            $table->boolean('salon_cakismamasi')->default(0); // Salon Çakışması (0 veya 1)
            $table->integer('sart_sayisi'); // Şart Sayısı
            $table->json('ders_sartlari'); // Ders Şartları (JSON olarak kaydedilecek)
            $table->timestamps(); // Oluşturulma ve güncellenme zamanları

            // Foreign key tanımlaması
            $table->foreign('bolum_id')->references('id')->on('bolumler')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ders_programi_sartlari');
    }
}
