<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('equips', function (Blueprint $table) {
            $table->unsignedBigInteger('categoria_id')->nullable()->after('nom');
            $table->unsignedBigInteger('subcategoria_id')->nullable()->after('categoria_id');

            $table->foreign('categoria_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('subcategoria_id')->references('id')->on('subcategories')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('equips', function (Blueprint $table) {
            $table->dropForeign(['categoria_id']);
            $table->dropForeign(['subcategoria_id']);
            $table->dropColumn('categoria_id');
            $table->dropColumn('subcategoria_id');
        });
    }
};
