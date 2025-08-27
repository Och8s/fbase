<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pre_campus', function (Blueprint $table) {
            $table->text('observacions')->nullable()->after('incapacitat');
            $table->string('recollida', 50)->nullable()->after('observacions'); // p.ej. "08:00-09:00"
        });
    }

    public function down(): void
    {
        Schema::table('pre_campus', function (Blueprint $table) {
            $table->dropColumn(['observacions', 'recollida']);
        });
    }
};
