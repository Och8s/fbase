<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pre_campus', function (Blueprint $table) {
            // Si era varchar/enum, lo cambiamos a boolean
            $table->boolean('recollida')->default(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('pre_campus', function (Blueprint $table) {
            // Revertir si antes era string (ajusta según lo que tuvieras)
            $table->string('recollida')->nullable()->change();
        });
    }
};
