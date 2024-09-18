<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkademisyenlerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akademisyenler', function (Blueprint $table) {
            $table->id();
            $table->char('guid', 36)->unique();
            $table->string('isim');
            $table->string('soyisim');
            $table->string('kisa_kod', 10)->nullable();
            $table->enum('cinsiyet', ['Erkek', 'Kadın']);
            $table->string('unvan');
            $table->unsignedBigInteger('bolum_id');
            $table->unsignedBigInteger('fakulte_id');
            $table->string('email')->unique();
            $table->string('renk_kodu', 7);
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('bolum_id')->references('id')->on('bolumler')->onDelete('cascade');
            $table->foreign('fakulte_id')->references('id')->on('fakulteler')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('akademisyenler');
    }
}
