<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['nom' => 'Babies',      'durada_oficial' => 40, 'tipus_canvis' => 'limitats'],
            ['nom' => 'Prebenjamín','durada_oficial' => 48, 'tipus_canvis' => 'limitats'],
            ['nom' => 'Benjamín',   'durada_oficial' => 48, 'tipus_canvis' => 'limitats'],
            ['nom' => 'Alevín',     'durada_oficial' => 60, 'tipus_canvis' => 'limitats'],
            ['nom' => 'Infantil',   'durada_oficial' => 70, 'tipus_canvis' => 'limitats'],
            ['nom' => 'Cadete',     'durada_oficial' => 80, 'tipus_canvis' => 'limitats'],
            ['nom' => 'Juvenil',    'durada_oficial' => 90, 'tipus_canvis' => 'limitats'],
            ['nom' => 'Amateur',    'durada_oficial' => 90, 'tipus_canvis' => 'limitats'],
        ];

        foreach ($categories as $cat) {
            Categoria::create($cat);
        }
    }
}
