<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('equips', function (Blueprint $table) {
        $table->unsignedBigInteger('modalitat_id')->nullable()->after('categoria_id');
        $table->foreign('modalitat_id')->references('id')->on('modalitats')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('equips', function (Blueprint $table) {
        $table->dropForeign(['modalitat_id']);
        $table->dropColumn('modalitat_id');
    });
}



};
