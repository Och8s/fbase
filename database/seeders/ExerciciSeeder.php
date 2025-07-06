<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exercici;

class ExerciciSeeder extends Seeder
{
    public function run(): void
    {
        Exercici::create([
            'entrenador_id' => 1,
            'coordinador_id' => null,
            'titol' => 'Passades en triangle',
            'eina' => 'Sense_iden',
            'objectiu_principal' => 'Millorar la precisió de passades i desmarcatges',
            'descripcio' => 'Els jugadors passen i es mouen per formar un triangle en moviment.',
            'dibuix' => null,
            'tasca_oberta' => 30,
            'treball_tecnic' => 80,
            'treball_tactic' => 60,
            'treball_fisic' => 20,
            'treball_cognitiu' => 40,
            'fases_joc' => json_encode(['Atac', 'Transició defensiva']),
            'espai' => 'Zona reduïda',
            'durada_total' => 15,
            'durada_repeticio' => 5,
            'num_jugadors' => 6,
            'repeticions' => 3,
        ]);

        Exercici::create([
            'entrenador_id' => 1,
            'coordinador_id' => null,
            'titol' => 'Pressió en bloc',
            'eina' => 'Joc Reduit',
            'objectiu_principal' => 'Coordinació tàctica en defensa',
            'descripcio' => 'Simulació de situacions defensives en bloc mig.',
            'dibuix' => null,
            'tasca_oberta' => 50,
            'treball_tecnic' => 30,
            'treball_tactic' => 90,
            'treball_fisic' => 60,
            'treball_cognitiu' => 70,
            'fases_joc' => json_encode(['Defensa', 'Transició defensiva']),
            'espai' => '3/4 camp',
            'durada_total' => 20,
            'durada_repeticio' => 6,
            'num_jugadors' => 10,
            'repeticions' => 2,
        ]);
    }
}
