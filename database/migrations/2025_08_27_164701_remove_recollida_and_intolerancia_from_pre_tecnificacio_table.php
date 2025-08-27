<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pre_tecnificacio', function (Blueprint $table) {
            if (Schema::hasColumn('pre_tecnificacio', 'recollida')) {
                $table->dropColumn('recollida');
            }
            if (Schema::hasColumn('pre_tecnificacio', 'intolerancia')) {
                $table->dropColumn('intolerancia');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pre_tecnificacio', function (Blueprint $table) {
            $table->boolean('recollida')->default(false)->after('email');
            $table->text('intolerancia')->nullable()->after('es_jugador_club');
        });
    }
};
