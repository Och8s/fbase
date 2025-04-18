<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Jugador;
use Illuminate\Support\Facades\Hash;

class TutorJuanGarciaSeeder extends Seeder
{
    public function run(): void
    {
        // Crear el tutor Juan García
        $tutor = User::create([
            'name' => 'Juan García',
            'email' => 'juan.garcia@example.com',
            'password' => Hash::make('password123'),
            'rol' => 'tutor',
            'dni' => 'TUTOR999999',
        ]);

        // Buscar el jugador con apellido García
        $jugador = Jugador::where('cognoms', 'García')->first();

        // Asociar el tutor al jugador si existe
        if ($jugador) {
            $tutor->jugadors()->attach($jugador->id);
        }
    }
}
