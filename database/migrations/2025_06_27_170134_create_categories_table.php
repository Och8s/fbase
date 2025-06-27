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
       Schema::create('categories', function (Blueprint $table) {
    $table->id();
    $table->string('nom'); // Aleví, Infantil, etc.
    $table->integer('durada_oficial')->nullable(); // Minuts per partit
    $table->enum('tipus_canvis', ['lliures', 'limitats'])->default('limitats');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
