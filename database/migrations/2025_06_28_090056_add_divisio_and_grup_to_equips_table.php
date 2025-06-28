<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('equips', function (Blueprint $table) {
            $table->enum('divisio', [
                '2_div', '1_div', 'prefer', 'div_hon',
                'nacional', '3_fed', '2_fed', '1_fed'
            ])->nullable()->after('entrenador_id');

            $table->integer('grup')->nullable()->after('divisio');
            $table->string('codi_fed', 50)->nullable()->after('grup');
        });
    }

    public function down(): void
    {
        Schema::table('equips', function (Blueprint $table) {
            $table->dropColumn(['divisio', 'grup', 'codi_fed']);
        });
    }
};
