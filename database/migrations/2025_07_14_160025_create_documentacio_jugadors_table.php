<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('documentacio_jugadors', function (Blueprint $table) {
            $table->id('id_documentacio');
            $table->unsignedBigInteger('id_jugador');
            $table->enum('dni', ['Sí', 'No'])->default('No');
            $table->enum('nie', ['Sí', 'No'])->default('No');
            $table->enum('passaport', ['Sí', 'No'])->default('No');
            $table->enum('tarjeta_sanitaria', ['Sí', 'No'])->default('No');
            $table->enum('foto', ['Sí', 'No'])->default('No');
            $table->enum('portal_federat', ['Sí', 'No'])->default('No');
            $table->enum('mutua', ['Sí', 'No'])->default('No');
            $table->enum('consentiment', ['Sí', 'No'])->default('No');
            $table->enum('drets_imatges', ['Sí', 'No'])->default('No');
            $table->enum('politica_privacitat', ['Sí', 'No'])->default('No');
            $table->enum('regim_intern', ['Sí', 'No'])->default('No');
            $table->enum('proteccio_dades', ['Sí', 'No'])->default('No');
            $table->enum('protocol_violencia_sexual', ['Sí', 'No'])->default('No');
            $table->enum('certificat_medic', ['Sí', 'No'])->default('No');
            $table->enum('autoritzacio_paterna', ['Sí', 'No'])->default('No');
            $table->enum('resguard_pagament', ['Sí', 'No'])->default('No');
            $table->enum('certificat_empadronament', ['Sí', 'No'])->default('No');
            $table->enum('certificat_escolaritzacio', ['Sí', 'No'])->default('No');
            $table->enum('permiso_residencia_trabajo', ['Sí', 'No'])->default('No');
            $table->enum('fotocopia_custodia', ['Sí', 'No'])->default('No'); // Nou camp
            $table->date('data_aportacio')->nullable();
            $table->foreign('id_jugador')->references('id')->on('jugadors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('documentacio_jugadors');
    }
};
