<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Coordinador General',
            'email' => 'coordinador@vilaseca.cat',
            'password' => Hash::make('password123'),  // Canvia la contrasenya si vols!
            'rol' => 'coordinador',
            'dni' => '22334450F',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
