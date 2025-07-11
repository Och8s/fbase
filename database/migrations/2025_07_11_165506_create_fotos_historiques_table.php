
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('fotos_historiques', function (Blueprint $table) {
            $table->id();
            $table->string('titol');
            $table->string('foto'); // nom del fitxer o URL
            $table->string('facilitador');
            $table->text('descripcio')->nullable();
            $table->date('data')->nullable();
            $table->string('lloc')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fotos_historiques');
    }
};
