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
    Schema::create('noticies', function (Blueprint $table) {
        $table->id();
        $table->string('titol');
        $table->date('data');
        $table->string('foto')->nullable(); // pot ser nullable si no hi ha imatge
        $table->text('descripcio');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('noticies');
}

};
