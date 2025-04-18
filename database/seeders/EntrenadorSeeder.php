<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EntrenadorSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Joan Coll',
            'email' => 'entrenador@vilaseca.cat',
            'password' => Hash::make('password'), // Asegúrate de cambiar la contraseña
            'rol' => 'entrenador',
            'dni' => '11223344E',
        ]);
    }
}

