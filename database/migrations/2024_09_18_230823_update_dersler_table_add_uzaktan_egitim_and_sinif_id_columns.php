<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDerslerTableAddUzaktanEgitimAndSinifIdColumns extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('dersler', function (Blueprint $table) {
            $table->boolean('uzaktan_egitim')->default(0)->after('renk_kodu'); // Online ders olup olmadığını belirten sütun
            $table->json('sinif_id')->nullable()->after('uzaktan_egitim'); // Sınıf/salon ID'lerinin JSON formatında saklanması
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dersler', function (Blueprint $table) {
            $table->dropColumn('uzaktan_egitim');
            $table->dropColumn('sinif_id');
        });
    }
}
