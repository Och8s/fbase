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
Schema::create('pre_socis', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('dni')->unique();
    $table->date('data_naix')->nullable();
    $table->string('telefon')->nullable();
    $table->string('adreca')->nullable();     // 👈 Adreça postal
    $table->string('poblacio')->nullable();   // 👈 Ciutat o poble
    $table->string('numero_compte')->nullable();
    $table->enum('estat', ['pendent', 'acceptat', 'rebutjat'])->default('pendent');
    $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_socis');
    }
};
