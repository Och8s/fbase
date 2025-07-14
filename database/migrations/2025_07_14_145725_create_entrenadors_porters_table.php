<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entrenadors_porters', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('cognoms');
            $table->string('dni')->unique();
            $table->string('telefon')->nullable();
            $table->string('equips')->nullable(); // Ex: "1r Equip, Aleví B"
            $table->string('titulacio')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entrenadors_porters');
    }
};
