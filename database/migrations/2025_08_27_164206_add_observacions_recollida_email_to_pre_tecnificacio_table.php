<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pre_tecnificacio', function (Blueprint $table) {
            $table->string('email')->nullable()->after('telefon');
            $table->boolean('recollida')->default(false)->after('email');
            $table->text('observacions')->nullable()->after('recollida');
        });
    }

    public function down(): void
    {
        Schema::table('pre_tecnificacio', function (Blueprint $table) {
            $table->dropColumn(['email', 'recollida', 'observacions']);
        });
    }
};
