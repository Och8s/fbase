<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('equip_exercici', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equip_id')->constrained()->onDelete('cascade');
            $table->foreignId('exercici_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('equip_exercici');
    }
};
