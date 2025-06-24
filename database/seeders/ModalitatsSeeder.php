<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModalitatsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('modalitats')->insert([
            [
                'nom' => 'F7',
                'espai_entren' => 'mig_camp',
                'camp_partit' => 'mig_camp',
                'coordinador_id' => 20, // Substitueix per l'ID del coordinador correcte
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'F11',
                'espai_entren' => 'mig_camp',
                'camp_partit' => 'camp_sencer',
                'coordinador_id' => 19, // Substitueix per l'ID del coordinador correcte
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Femení',
                'espai_entren' => null,
                'camp_partit' => null,
                'coordinador_id' => 19, // Substitueix per l'ID del coordinador femení correcte
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
