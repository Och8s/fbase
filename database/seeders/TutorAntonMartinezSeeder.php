<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Jugador;
use Illuminate\Support\Facades\Hash;

class TutorAntonMartinezSeeder extends Seeder
{
    public function run(): void
    {
        // Crear el tutor Juan García
        $tutor = User::create([
            'name' => 'Anton Martínez',
            'email' => 'Anto.martinez@example.com',
            'password' => Hash::make('password123'),
            'rol' => 'tutor',
            'dni' => 'TUTOR999998',
        ]);

        // Buscar el jugador con apellido García
        $jugador = Jugador::where('cognoms', 'Martínez')->first();

        // Asociar el tutor al jugador si existe
        if ($jugador) {
            $tutor->jugadors()->attach($jugador->id);
        }
    }
}

