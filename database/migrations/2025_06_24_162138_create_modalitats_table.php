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
    Schema::create('modalitats', function (Blueprint $table) {
        $table->id();
        $table->string('nom');  // Nom de la modalitat: F7, F11, Femení, etc.
        $table->enum('espai_entren', ['un_quart', 'mig_camp'])->nullable()->comment('Espai per entrenaments');
        $table->enum('camp_partit', ['mig_camp', 'camp_sencer'])->nullable()->comment('Espai per partits');
        $table->unsignedBigInteger('coordinador_id');
        $table->timestamps();
        $table->foreign('coordinador_id')->references('id')->on('users')->onDelete('cascade');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modalitats');
    }
};
