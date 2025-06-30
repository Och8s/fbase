<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rebuts', function (Blueprint $table) {
            $table->id();
            $table->string('num_rebut'); // Exemple: REB01_JUG12
            $table->date('data_rebut');
            $table->unsignedBigInteger('jugador_id');
            $table->decimal('quantitat', 8, 2);
            $table->date('data_pagament')->nullable();
            $table->boolean('pagat')->default(false);
            $table->timestamps();

            $table->foreign('jugador_id')->references('id')->on('jugadors')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rebuts');
    }
};
