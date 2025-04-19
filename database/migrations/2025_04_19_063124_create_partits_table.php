<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equip_id'); // FK → equips.id
            $table->string('rival');
            $table->date('data');
            $table->boolean('local'); // true = local, false = visitant
            $table->integer('jornada');
            $table->integer('gols_favor')->nullable();
            $table->integer('gols_contra')->nullable();
            $table->boolean('partit_jugat')->default(false);
            $table->timestamps();

            $table->foreign('equip_id')->references('id')->on('equips')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partits');
    }
};
