<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Jugador;
use Illuminate\Support\Facades\Hash;

class TutorLeonPerezSeeder extends Seeder
{
    public function run(): void
    {
        // Crear el tutor perez
        $tutor = User::create([
            'name' => 'Leon Perez',
            'email' => 'xlion@example.com',
            'password' => Hash::make('password123'),
            'rol' => 'tutor',
            'dni' => 'TUTOR293999',
        ]);

        // Buscar el jugador con apellido García
        $jugador = Jugador::where('cognoms', 'Pérez')->first();

        // Asociar el tutor al jugador si existe
        if ($jugador) {
            $tutor->jugadors()->attach($jugador->id);
        }
    }
}
