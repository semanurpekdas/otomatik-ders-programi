<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkademisyenGunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akademisyen_gun', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('akademisyen_id');
            $table->json('gunler')->nullable(); // Günler JSON formatında tutulacak
            $table->timestamps();

            // Foreign key
            $table->foreign('akademisyen_id')->references('id')->on('akademisyenler')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('akademisyen_gun');
    }
}
