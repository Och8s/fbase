<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EntrenadorsPortersSeeder extends Seeder
{
    public function run()
    {
        DB::table('entrenadors_porters')->insert([
            [
                'nom' => 'Joan',
                'cognoms' => 'Pérez García',
                'dni' => '12345678A',
                'telefon' => '666123456',
                'equips' => 'Porteros Sub-12',
                'titulacio' => 'Nivel 2 UEFA',
                'foto' => 'public/images/porters/entrenadorsP1.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom' => 'Marta',
                'cognoms' => 'López Sánchez',
                'dni' => '23456789B',
                'telefon' => '666654321',
                'equips' => 'Porteros Sub-14',
                'titulacio' => 'Nivel 3 FIFA',
                'foto' => 'public/images/porters/entrenadorsP2.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom' => 'Carlos',
                'cognoms' => 'Martínez Ruiz',
                'dni' => '34567890C',
                'telefon' => '667987654',
                'equips' => 'Porteros Sub-16',
                'titulacio' => 'Nivel 1 UEFA',
                'foto' => 'public/images/porters/entrenadorsP3.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom' => 'Lucía',
                'cognoms' => 'Gómez Fernández',
                'dni' => '45678901D',
                'telefon' => '668345678',
                'equips' => 'Porteros Sub-18',
                'titulacio' => 'Nivel 2 UEFA',
                'foto' => 'public/images/porters/entrenadorsP4.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom' => 'Víctor',
                'cognoms' => 'Vázquez Ruiz',
                'dni' => '56789012E',
                'telefon' => '669876543',
                'equips' => 'Porteros Juvenil',
                'titulacio' => 'Nivel 3 FIFA',
                'foto' => 'public/images/porters/entrenadorsP5.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
