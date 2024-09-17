<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalonlarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salonlar', function (Blueprint $table) {
            $table->id();
            $table->uuid('guid')->unique();
            $table->string('isim');
            $table->unsignedBigInteger('fakulte_id');
            $table->unsignedBigInteger('bolum_id');
            $table->integer('kapasite');
            $table->string('renk_kodu');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('fakulte_id')->references('id')->on('fakulteler')->onDelete('cascade');
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
        Schema::dropIfExists('salonlar');
    }
}

