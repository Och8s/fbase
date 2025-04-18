<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Jugador;
use Illuminate\Support\Facades\Hash;

class TutorDomi1Seeder extends Seeder
{
    public function run(): void
    {
        // Crear el tutor
        $tutor = User::create([
            'name' => 'Juan Domínguez',
            'email' => 'jdomin@example.com',
            'password' => Hash::make('password123'),
            'rol' => 'tutor',
            'dni' => 'TUTOR141377',
        ]);

        // Buscar el jugador con apellido García
        $jugador = Jugador::where('cognoms', 'Domínguez')->first();

        // Asociar el tutor al jugador si existe
        if ($jugador) {
            $tutor->jugadors()->attach($jugador->id);
        }
    }
}
