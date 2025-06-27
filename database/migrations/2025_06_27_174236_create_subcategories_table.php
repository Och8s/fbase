<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
      Schema::create('subcategories', function (Blueprint $table) {
    $table->id();
    $table->string('nom');
    $table->unsignedBigInteger('categoria_id')->nullable();
    $table->timestamps();

    $table->foreign('categoria_id')->references('id')->on('categories')->onDelete('set null');
});
    }

    public function down(): void
    {
        Schema::dropIfExists('subcategories');
    }
};
