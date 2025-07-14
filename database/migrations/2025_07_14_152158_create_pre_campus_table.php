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
      Schema::create('pre_campus', function (Blueprint $table) {
    $table->id();
    $table->string('nom');
    $table->string('cognoms');
    $table->string('dni')->unique();
    $table->string('seg_social')->nullable();
    $table->date('data_naixement');
    $table->string('domicili')->nullable();
    $table->string('cp')->nullable();
    $table->string('telefon')->nullable();
    $table->string('nom_pares')->nullable();
    $table->string('num_compte')->nullable();
    $table->boolean('consentiment_pares')->default(false);
    $table->boolean('drets_imatge')->default(false);
    $table->boolean('es_jugador_club')->default(false);
    $table->text('intolerancia')->nullable();
    $table->text('incapacitat')->nullable();
    $table->enum('estat', ['pendent', 'acceptat', 'rebutjat'])->default('pendent');
    $table->foreignId('jugador_id')->nullable()->constrained('jugadors')->onDelete('set null');
    $table->timestamps();
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_campus');
    }
};
