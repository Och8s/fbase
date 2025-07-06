<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pro_exercicis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entrenador_id')->constrained('users')->onDelete('cascade');
            $table->string('titol');
            $table->enum('eina', [
                'Joc Real', 'Joc Reduit', 'Atac/Def', 'Posessió',
                'Rondos', 'Circuit', 'Automatismes', 'Calentament',
                'Finalitzacions', 'Sense_iden'
            ]);
            $table->string('objectiu_principal')->nullable();
            $table->text('descripcio')->nullable();
            $table->string('dibuix')->nullable();

            $table->integer('tasca_oberta')->nullable();
            $table->integer('treball_tecnic')->nullable();
            $table->integer('treball_tactic')->nullable();
            $table->integer('treball_fisic')->nullable();
            $table->integer('treball_cognitiu')->nullable();

            $table->json('fases_joc')->nullable();

            $table->enum('estat', ['pendent', 'acceptat', 'rebutjat', 'publicat'])->default('pendent');

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('pro_exercicis');
    }
};
