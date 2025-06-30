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
    Schema::create('entrenador_equip', function (Blueprint $table) {
        $table->id();
        $table->foreignId('usuari_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('equip_id')->constrained('equips')->onDelete('cascade');
        $table->string('rol_ent')->default('auxiliar'); // o 'principal', 'segon', etc.
        $table->timestamps();

        $table->unique(['usuari_id', 'equip_id']); // Evita duplicats
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrenador_equip');
    }
};
