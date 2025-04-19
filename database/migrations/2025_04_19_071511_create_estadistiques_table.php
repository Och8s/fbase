<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estadistiques', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jugador_id');
            $table->unsignedBigInteger('partit_id');
            $table->boolean('partido_jugado')->default(false);
            $table->boolean('titular')->default(false);
            $table->integer('gols_jugador')->nullable();
            $table->integer('minuts_jugats')->nullable();
            $table->integer('punts_equip_jjp')->nullable();
            $table->integer('punts_equip_jec')->nullable();
            $table->integer('gols_favor_jec')->nullable();
            $table->integer('gols_contra_jec')->nullable();
            $table->integer('dif_gols_jec')->nullable();
            $table->timestamps();

            $table->foreign('jugador_id')->references('id')->on('jugadors')->onDelete('cascade');
            $table->foreign('partit_id')->references('id')->on('partits')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estadistiques');
    }
};


