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
    Schema::create('act_y_even', function (Blueprint $table) {
        $table->id();
        $table->string('titol');
        $table->string('foto')->nullable();
        $table->text('descripcio');
        $table->date('data_inici');
        $table->date('data_final');
        $table->string('horari')->nullable();
        $table->boolean('dinar')->default(false);
        $table->decimal('preu', 8, 2)->nullable();
        $table->timestamps();
    });

    Schema::create('sub_activitats', function (Blueprint $table) {
        $table->id();
        $table->foreignId('act_y_even_id')->constrained('act_y_even')->onDelete('cascade');
        $table->string('titol');
        $table->string('horari')->nullable();
        $table->text('descripcio')->nullable();
        $table->timestamps();
    });
}

};
