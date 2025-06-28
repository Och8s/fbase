<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('equips', function (Blueprint $table) {
            $table->dropColumn('categoria');
        });
    }

    public function down(): void
    {
        Schema::table('equips', function (Blueprint $table) {
            $table->string('categoria')->nullable(); // o sense nullable, com ho tenies
        });
    }
};

