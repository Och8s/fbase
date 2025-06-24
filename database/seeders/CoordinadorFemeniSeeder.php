<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CoordinadorFemeniSeeder extends Seeder
{
    public function run(): void
    {
        $dni = '22134450F';

        $exists = DB::table('users')->where('dni', $dni)->exists();

        if (!$exists) {
            DB::table('users')->insert([
                'name' => 'Coordinador F7',
                'email' => 'coordinador2@vilaseca.cat',
                'password' => Hash::make('password123'),
                'rol' => 'coordinador',
                'dni' => $dni,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
