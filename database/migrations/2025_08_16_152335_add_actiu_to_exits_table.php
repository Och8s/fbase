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
    Schema::table('exits', function (Blueprint $table) {
        $table->boolean('actiu')->default(false)->after('data')->index();
    });
}

public function down()
{
    Schema::table('exits', function (Blueprint $table) {
        $table->dropColumn('actiu');
    });
}


};
