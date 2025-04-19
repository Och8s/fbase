<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gols', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partit_id')->constrained()->onDelete('cascade');
            $table->foreignId('jugador_id')->nullable()->constrained('jugadors')->onDelete('set null');
            $table->integer('minut');
            $table->enum('tipo_gol', ['favor', 'contra']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gols');
    }
};

