<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equip;

class EquipSeeder extends Seeder
{
    public function run(): void
    {
        Equip::create([
            'nom' => 'Vilaseca A',
            'categoria' => 'Infantil',
            'entrenador_id' => 1, // Asegúrate de que este ID corresponda a un usuario existente con rol 'entrenador'
        ]);
    }
}
