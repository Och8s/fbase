<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_jugadors_historics_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('jugadors_historics', function (Blueprint $table) {
            $table->id();
            $table->string('nom');             // Rogelio
            $table->string('cognoms');         // Gistau
            $table->string('apodo')->nullable();   // "Coque"
            $table->string('foto')->nullable();    // /images/historia/coque.jpg
            $table->string('posicio')->nullable(); // DC, MIG, POR...
            $table->string('etapa_curta')->nullable(); // “1988–1992 (juvenil/primer equip)”
            $table->text('descripcio_curta')->nullable(); // 1-2 frases per targeta
            $table->longText('descripcio_llarga')->nullable(); // Amb <br> o <p>
            $table->boolean('actiu')->default(true);
            $table->unsignedInteger('ordre')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('jugadors_historics');
    }
};
