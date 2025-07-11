<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('patrocinadors', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('logo')->nullable(); // ruta de la imatge
            $table->string('enllac_web')->nullable(); // enllaç a la seva web
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patrocinadors');
    }
};
