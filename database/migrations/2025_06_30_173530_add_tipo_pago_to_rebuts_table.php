<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('rebuts', function (Blueprint $table) {
            $table->enum('tipo_pago', ['contado', 'bizum', 'ingreso'])->nullable()->after('pagat');
        });
    }

    public function down(): void {
        Schema::table('rebuts', function (Blueprint $table) {
            $table->dropColumn('tipo_pago');
        });
    }
};

