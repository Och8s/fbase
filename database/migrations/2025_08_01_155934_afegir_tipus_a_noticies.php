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
    Schema::table('noticies', function (Blueprint $table) {
        $table->enum('seccio', [
            'primer_equip',
            'segon_equip',
            'futbol_base',
            'federacio',
            'poble',
            'club',
            'futbol_femeni'
        ])->default('club');
    });
}

public function down()
{
    Schema::table('noticies', function (Blueprint $table) {
        $table->dropColumn('seccio');
    });
}




};
