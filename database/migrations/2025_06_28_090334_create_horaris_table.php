<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('horaris', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('equip_id');
        $table->string('lloc');
        $table->enum('camp', ['1', '2', '3', '4', '5', '6', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H']);
        $table->time('h_inici');
        $table->time('h_final');
        $table->integer('durada'); // minuts
        $table->enum('tipus_act', ['entrenament', 'partit']);
        $table->enum('vestuari', ['1', '2', '3', '4', '5', '6', '7', '8']);
        $table->timestamps();

        // Clau forana
        $table->foreign('equip_id')->references('id')->on('equips')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horaris');
    }
};
