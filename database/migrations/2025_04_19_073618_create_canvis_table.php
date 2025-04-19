<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('canvis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partit_id');
            $table->unsignedBigInteger('jugador_entra_id');
            $table->unsignedBigInteger('jugador_surt_id');
            $table->integer('minut');
            $table->timestamps();

            $table->foreign('partit_id')->references('id')->on('partits')->onDelete('cascade');
            $table->foreign('jugador_entra_id')->references('id')->on('jugadors')->onDelete('cascade');
            $table->foreign('jugador_surt_id')->references('id')->on('jugadors')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('canvis');
    }
};
