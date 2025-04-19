<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partit;
use Carbon\Carbon;

class PartitsSeeder extends Seeder
{
    public function run(): void
    {
        $rivals = [
            'UE Salou',
            'AE La Canonja',
            'Torreforta FC',
            'Reus CF',
            'Santes Creus FB',
        ];

        $startDate = Carbon::create(2025, 4, 19); // Fecha inicial: 19 de abril de 2025
        $equipId = 1;

        // Primeros 5 partidos en casa
        foreach ($rivals as $index => $rival) {
            Partit::create([
                'equip_id' => $equipId,
                'rival' => $rival,
                'data' => $startDate->copy()->addWeeks($index),
                'local' => true,
                'jornada' => $index + 1,
                'gols_favor' => null,
                'gols_contra' => null,
                'partit_jugat' => false,
            ]);
        }

        // Siguientes 5 partidos fuera
        foreach ($rivals as $index => $rival) {
            Partit::create([
                'equip_id' => $equipId,
                'rival' => $rival,
                'data' => $startDate->copy()->addWeeks($index + 5),
                'local' => false,
                'jornada' => $index + 6,
                'gols_favor' => null,
                'gols_contra' => null,
                'partit_jugat' => false,
            ]);
        }
    }
}

