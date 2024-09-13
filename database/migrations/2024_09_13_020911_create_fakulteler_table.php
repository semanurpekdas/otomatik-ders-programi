<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakultelerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fakulteler', function (Blueprint $table) {
            $table->id(); // Otomatik artan id
            $table->string('fakulte_isim'); // Fakülte ismi
            $table->unsignedBigInteger('uni_id'); // Üniversite ID'si
            $table->timestamps();

            // İlişki için foreign key tanımlaması (üniversite tablosuyla ilişkilendirme)
            $table->foreign('uni_id')->references('id')->on('universiteler')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fakulteler');
    }
}
