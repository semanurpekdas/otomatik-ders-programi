<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBolumIdToAkademisyengunTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('akademisyen_gun', function (Blueprint $table) {
            $table->unsignedBigInteger('bolum_id')->after('id'); // bolum_id sütunu ekleniyor
            $table->foreign('bolum_id')->references('id')->on('bolumler')->onDelete('cascade'); // Foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('akademisyen_gun', function (Blueprint $table) {
            $table->dropForeign(['bolum_id']);
            $table->dropColumn('bolum_id');
        });
    }
}
