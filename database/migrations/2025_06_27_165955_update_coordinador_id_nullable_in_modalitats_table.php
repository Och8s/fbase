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
    Schema::table('modalitats', function (Blueprint $table) {
        $table->dropForeign(['coordinador_id']); // Elimina la clau antiga
        $table->unsignedBigInteger('coordinador_id')->nullable()->change();
        $table->foreign('coordinador_id')->references('id')->on('users')->nullOnDelete();
    });
}

public function down(): void
{
    Schema::table('modalitats', function (Blueprint $table) {
        $table->dropForeign(['coordinador_id']);
        $table->unsignedBigInteger('coordinador_id')->nullable(false)->change();
        $table->foreign('coordinador_id')->references('id')->on('users')->onDelete('cascade');
    });
}

};
