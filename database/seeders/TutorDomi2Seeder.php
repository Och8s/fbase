<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Jugador;
use Illuminate\Support\Facades\Hash;

class TutorDomi2Seeder extends Seeder
{
    public function run(): void
    {
        // Crear el tutor
        $tutor = User::create([
            'name' => 'Ana Ortega',
            'email' => 'anaortegaortega1982@gmail.com',
            'password' => Hash::make('password122'),
            'rol' => 'tutor',
            'dni' => 'TUTOR111377',
        ]);

        // Buscar el jugador con apellido García
        $jugador = Jugador::where('cognoms', 'Domínguez')->first();

        // Asociar el tutor al jugador si existe
        if ($jugador) {
            $tutor->jugadors()->attach($jugador->id);
        }
    }
}
