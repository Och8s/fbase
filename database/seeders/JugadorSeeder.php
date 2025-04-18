<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jugador;

class JugadorSeeder extends Seeder
{
    public function run(): void
    {
        $jugadors = [
            [
                'nom' => 'Marc',
                'cognoms' => 'García',
                'dni' => '12345678A',
                'data_naixement' => '2012-01-15',
                'dorsal' => 10,
                'equip_id' => 1,
            ],
            [
                'nom' => 'Laura',
                'cognoms' => 'Martínez',
                'dni' => '23456789B',
                'data_naixement' => '2012-02-20',
                'dorsal' => 7,
                'equip_id' => 1,
            ],
            [
                'nom' => 'Carlos',
                'cognoms' => 'López',
                'dni' => '34567890C',
                'data_naixement' => '2012-03-10',
                'dorsal' => 9,
                'equip_id' => 1,
            ],
            [
                'nom' => 'Ana',
                'cognoms' => 'Sánchez',
                'dni' => '45678901D',
                'data_naixement' => '2012-04-05',
                'dorsal' => 11,
                'equip_id' => 1,
            ],
            [
                'nom' => 'David',
                'cognoms' => 'Pérez',
                'dni' => '56789012E',
                'data_naixement' => '2012-05-25',
                'dorsal' => 8,
                'equip_id' => 1,
            ],
            [
                'nom' => 'Elena',
                'cognoms' => 'Gómez',
                'dni' => '67890123F',
                'data_naixement' => '2012-06-30',
                'dorsal' => 6,
                'equip_id' => 1,
            ],
            [
                'nom' => 'Javier',
                'cognoms' => 'Ruiz',
                'dni' => '78901234G',
                'data_naixement' => '2012-07-12',
                'dorsal' => 5,
                'equip_id' => 1,
            ],
            [
                'nom' => 'Marta',
                'cognoms' => 'Hernández',
                'dni' => '89012345H',
                'data_naixement' => '2012-08-18',
                'dorsal' => 4,
                'equip_id' => 1,
            ],
            [
                'nom' => 'Sergio',
                'cognoms' => 'Díaz',
                'dni' => '90123456I',
                'data_naixement' => '2012-09-22',
                'dorsal' => 3,
                'equip_id' => 1,
            ],
            [
                'nom' => 'Lucía',
                'cognoms' => 'Moreno',
                'dni' => '01234567J',
                'data_naixement' => '2012-10-10',
                'dorsal' => 2,
                'equip_id' => 1,
            ],
            [
                'nom' => 'Andrés',
                'cognoms' => 'Álvarez',
                'dni' => '11234567K',
                'data_naixement' => '2012-11-05',
                'dorsal' => 1,
                'equip_id' => 1,
            ],
            [
                'nom' => 'Paula',
                'cognoms' => 'Romero',
                'dni' => '12234567L',
                'data_naixement' => '2012-12-15',
                'dorsal' => 12,
                'equip_id' => 1,
            ],
            [
                'nom' => 'Hugo',
                'cognoms' => 'Navarro',
                'dni' => '13234567M',
                'data_naixement' => '2012-01-25',
                'dorsal' => 13,
                'equip_id' => 1,
            ],
            [
                'nom' => 'Sara',
                'cognoms' => 'Torres',
                'dni' => '14234567N',
                'data_naixement' => '2012-02-14',
                'dorsal' => 14,
                'equip_id' => 1,
            ],
            [
                'nom' => 'Diego',
                'cognoms' => 'Domínguez',
                'dni' => '15234567O',
                'data_naixement' => '2012-03-03',
                'dorsal' => 15,
                'equip_id' => 1,
            ],
        ];

        foreach ($jugadors as $jugador) {
            Jugador::create($jugador);
        }
    }
}

