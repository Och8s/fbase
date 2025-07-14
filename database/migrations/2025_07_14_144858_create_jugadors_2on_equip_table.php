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
        Schema::create('jugadors_2on_equip', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('cognoms');
            $table->string('tipo_docu');
            $table->string('dni')->unique();
            $table->date('data_naixement');
            $table->integer('dorsal')->nullable();
            $table->integer('telefon')->nullable();
            $table->string('genere');
            $table->foreignId('equip_id')->constrained()->onDelete('cascade');
            $table->string('codi_fed')->nullable();
            $table->string('num_mut')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('docu_extranger')->default(false);
            $table->boolean('docu_complet')->default(false);
            $table->string('procedencia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadors_2on_equip');
    }
};
