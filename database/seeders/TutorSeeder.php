<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Jugador;
use Illuminate\Support\Facades\Hash;

class TutorSeeder extends Seeder
{
    public function run(): void
    {
        // Crear el tutor Adolfo gomez
        $tutor = User::create([
            'name' => 'Adolfo Gómez',
            'email' => 'adol@example.com',
            'password' => Hash::make('password123'),
            'rol' => 'tutor',
            'dni' => 'TUTOR193999',
        ]);

        // Buscar el jugador con apellido García
        $jugador = Jugador::where('cognoms', 'Gómez')->first();

        // Asociar el tutor al jugador si existe
        if ($jugador) {
            $tutor->jugadors()->attach($jugador->id);
        }
    }
}

