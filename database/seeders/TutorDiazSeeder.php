<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Jugador;
use Illuminate\Support\Facades\Hash;

class TutorDiazSeeder extends Seeder
{
    public function run(): void
    {
        // Crear el tutor
        $tutor = User::create([
            'name' => 'Juan Díaz',
            'email' => 'jd@example.com',
            'password' => Hash::make('password123'),
            'rol' => 'tutor',
            'dni' => 'TUTOR141999',
        ]);

        // Buscar el jugador con apellido García
        $jugador = Jugador::where('cognoms', 'Díaz')->first();

        // Asociar el tutor al jugador si existe
        if ($jugador) {
            $tutor->jugadors()->attach($jugador->id);
        }
    }
}
