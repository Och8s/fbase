<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class EntrenadorAuxiliarSeeder2 extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'jordi@vilaseca.cat'],
            [
                'name' => 'Jordi Entrenador',
                'password' => bcrypt('secret123'),
                'rol' => 'entrenador',
                'dni' => '12345678X',
            ]
        );

        // Associar a l'equip 1 com a auxiliar si no ho està ja
        if (!$user->equipsEntrenats()->where('equip_id', 1)->exists()) {
            $user->equipsEntrenats()->attach(1, ['rol_ent' => 'auxiliar']);
        }
    }
}

