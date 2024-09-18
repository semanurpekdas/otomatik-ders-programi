<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDerslerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dersler', function (Blueprint $table) {
            $table->id();
            $table->string('ders_adi');
            $table->string('kisa_isim');
            $table->enum('donem', ['Güz', 'Bahar']);
            $table->integer('ders_sayisi');
            $table->integer('ders_parcasi');
            $table->integer('sinif');
            $table->integer('alan_kisi_sayisi');
            $table->boolean('secmeli_durumu');
            $table->unsignedBigInteger('bolum_id');
            $table->unsignedBigInteger('hoca_id');
            $table->string('renk_kodu');
            $table->timestamps();

            $table->foreign('bolum_id')->references('id')->on('bolumler')->onDelete('cascade');
            $table->foreign('hoca_id')->references('id')->on('akademisyenler')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dersler');
    }
}
?>
