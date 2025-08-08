<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('events_porters', function (Blueprint $table) {
            $table->id();
            $table->string('titol');
            $table->text('descripcio');
            $table->date('data');
            $table->time('hora_inici')->nullable();
            $table->time('hora_fi')->nullable();
            $table->string('lloc')->nullable();
            $table->string('categoria')->nullable(); // esdeveniment, competició, social...
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events_porters');
    }
};
