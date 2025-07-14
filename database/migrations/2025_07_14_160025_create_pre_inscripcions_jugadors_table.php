<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pre_inscripcions_jugadors', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('cognoms');
            $table->string('dni')->unique();
            $table->string('seg_social');
            $table->date('data_naixement');
            $table->string('domicili');
            $table->string('cp', 10);
            $table->string('telefon');
            $table->json('noms_pares'); // Ex: {"mare": "Anna", "pare": "Joan"}
            $table->string('num_compte');
            $table->boolean('consentiment_pares')->default(false);
            $table->boolean('drets_imatge')->default(false);
            $table->boolean('es_jugador_club')->default(false);
            $table->text('intolerancia')->nullable();
            $table->text('incapacitat')->nullable();
            $table->enum('estat', ['pendent', 'acceptat', 'rebutjat', 'a_prova'])->default('pendent');
            $table->boolean('pares_separats')->default(false);
            $table->string('tipus_custodia')->nullable(); // Ex: "Compartida", "Mare", "Pare"
            $table->boolean('autoritzacio_cotxe_entrenador')->default(false);
            $table->boolean('autoritzacio_cotxe_pares')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('pre_inscripcions_jugadors');
    }
};
