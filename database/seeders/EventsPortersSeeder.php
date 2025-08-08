<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventsPortersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events_porters')->insert([
            [
                'titol' => 'Dia dels Porters',
                'descripcio' => 'Jornada especial dedicada a la formació i convivència dels porters del club. Inclou entrenaments específics, tallers de tècnica individual i activitats lúdiques per fomentar la cohesió de grup.',
                'data' => '2025-09-20',
                'hora_inici' => '10:00:00',
                'hora_fi' => '14:00:00',
                'lloc' => 'Camp Municipal',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'titol' => 'Batalla de Porters',
                'descripcio' => 'Competició amistosa on els porters s’enfronten en proves d’agilitat, reflexos i aturades espectaculars. Un esdeveniment pensat per posar a prova les habilitats en un ambient distès i divertit.',
                'data' => '2025-10-05',
                'hora_inici' => '09:30:00',
                'hora_fi' => '13:30:00',
                'lloc' => 'Pista Coberta',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'titol' => 'Menjar de Germanor',
                'descripcio' => 'Trobada de final de temporada amb tots els porters, famílies i entrenadors per compartir experiències, reconèixer els èxits de l’any i gaudir d’un dinar conjunt.',
                'data' => '2025-12-15',
                'hora_inici' => '13:00:00',
                'hora_fi' => '17:00:00',
                'lloc' => 'Sala Polivalent',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

