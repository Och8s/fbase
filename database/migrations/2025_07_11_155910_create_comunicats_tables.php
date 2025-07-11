<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comunicats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuari_id')->constrained('users')->onDelete('cascade');
            $table->string('titol');
            $table->text('missatge');
            $table->enum('tipus', ['individual', 'col·lectiu']);
            $table->enum('rol_desti', ['tutor', 'entrenador', 'soci', 'coordinador'])->nullable();
            $table->foreignId('equip_id')->nullable()->constrained('equips')->onDelete('set null');
            $table->boolean('enviat_per_email')->default(true);
            $table->string('arxiu')->nullable();
            $table->timestamps();
        });

        Schema::create('comunicat_usuari', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comunicat_id')->constrained('comunicats')->onDelete('cascade');
            $table->foreignId('usuari_id')->constrained('users')->onDelete('cascade');
            $table->boolean('llegit')->default(false);
            $table->timestamp('llegit_at')->nullable();
            $table->boolean('email_enviat')->default(false);
            $table->timestamp('email_enviat_at')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comunicat_usuari');
        Schema::dropIfExists('comunicats');
    }
};
