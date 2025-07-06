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
    Schema::table('exercicis', function (Blueprint $table) {
        $table->string('espai')->nullable();
        $table->string('durada_total')->nullable();
        $table->string('durada_repeticio')->nullable();
        $table->string('num_jugadors')->nullable();
        $table->integer('repeticions')->nullable();
    });
}

public function down(): void
{
    Schema::table('exercicis', function (Blueprint $table) {
        $table->dropColumn(['espai', 'durada_total', 'durada_repeticio', 'num_jugadors', 'repeticions']);
    });
}

};
