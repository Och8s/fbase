<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Jugador;
use Illuminate\Support\Facades\Hash;

class TutorAlvarezSeeder extends Seeder
{
    public function run(): void
    {
        // Crear el tutor
        $tutor = User::create([
            'name' => 'Antonia Armengol',
            'email' => 'armin@example.com',
            'password' => Hash::make('password123'),
            'rol' => 'tutor',
            'dni' => 'TUTOR101399',
        ]);

        // Buscar el jugador con apellido García
        $jugador = Jugador::where('cognoms', 'Álvarez')->first();

        // Asociar el tutor al jugador si existe
        if ($jugador) {
            $tutor->jugadors()->attach($jugador->id);
        }
    }
}
