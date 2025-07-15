<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::create('pre_historiques', function (Blueprint $table) {
        $table->id();
        $table->string('titol')->nullable();
        $table->string('foto'); // Ruta o nom d’arxiu
        $table->string('facilitador')->nullable(); // Nom de qui l'envia
        $table->text('descripcio')->nullable();
        $table->date('data')->nullable();
        $table->string('lloc')->nullable();
        $table->enum('estat', ['pendent', 'acceptada', 'rebutjada', 'pujada'])->default('pendent');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_historiques');
    }
};
