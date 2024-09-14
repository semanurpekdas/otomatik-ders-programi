<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bolumler', function (Blueprint $table) {
            $table->id();
            $table->string('bolum_isim');
            $table->foreignId('fakulte_id')->constrained('fakulteler')->onDelete('cascade');
            $table->foreignId('uni_id')->constrained('universiteler')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bolumler');
    }
};
