<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Crear la taula de reunions
        Schema::create('reunions', function (Blueprint $table) {
            $table->id();
            $table->string('titol');
            $table->foreignId('creador_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('equip_id')->nullable()->constrained('equips')->nullOnDelete();
            $table->date('data');
            $table->time('hora');
            $table->string('lloc')->nullable();
            $table->text('continguts')->nullable();
            $table->text('acords')->nullable();
            $table->timestamps();
        });

        // Crear la taula pivot entre reunions i usuaris
        Schema::create('reunio_usuari', function (Blueprint $table) {
            $table->foreignId('reunio_id')->constrained('reunions')->onDelete('cascade');
            $table->foreignId('usuari_id')->constrained('users')->onDelete('cascade');
            $table->primary(['reunio_id', 'usuari_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reunio_usuari');
        Schema::dropIfExists('reunions');
    }
};
