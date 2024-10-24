<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDersSinifToDerslerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dersler', function (Blueprint $table) {
            $table->json('ders_sinif')->nullable()->after('sinif_id'); // JSON formatında ders_sinif kolonu ekleniyor
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dersler', function (Blueprint $table) {
            $table->dropColumn('ders_sinif'); // Geri alma işlemi için ders_sinif kolonunu kaldırıyoruz
        });
    }
} 
