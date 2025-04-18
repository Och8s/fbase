<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Jugador;
use Illuminate\Support\Facades\Hash;

class TutorAlinaRuizSeeder extends Seeder
{
    public function run(): void
    {
        // Crear el tutor alina ruiz
        $tutor = User::create([
            'name' => 'Alina Ruiz',
            'email' => 'ruiz@example.com',
            'password' => Hash::make('password123'),
            'rol' => 'tutor',
            'dni' => 'TUTOR143999',
        ]);

        // Buscar el jugador con apellido García
        $jugador = Jugador::where('cognoms', 'Ruiz')->first();

        // Asociar el tutor al jugador si existe
        if ($jugador) {
            $tutor->jugadors()->attach($jugador->id);
        }
    }
}
