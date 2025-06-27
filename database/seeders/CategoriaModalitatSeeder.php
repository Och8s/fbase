<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modalitat;
use App\Models\Categoria;

class CategoriaModalitatSeeder extends Seeder
{
    public function run(): void
    {
        $assignacions = [
            'F7' => ['Babies', 'Prebenjamín', 'Benjamín', 'Alevín'],
            'F11' => ['Infantil', 'Cadete', 'Juvenil'],
            'Femení' => ['Alevín', 'Infantil', 'Cadete', 'Juvenil', 'Amateur'],
        ];

        foreach ($assignacions as $nomModalitat => $categoriesNoms) {
            $modalitat = Modalitat::where('nom', $nomModalitat)->first();

            if (!$modalitat) {
                echo "⚠️ Modalitat no trobada: $nomModalitat\n";
                continue;
            }

            foreach ($categoriesNoms as $nomCategoria) {
                $categoria = Categoria::where('nom', $nomCategoria)->first();
                if ($categoria && !$modalitat->categories->contains($categoria->id)) {
                    $modalitat->categories()->attach($categoria->id);
                    echo "✅ Assignada categoria '$nomCategoria' a modalitat '$nomModalitat'\n";
                }
            }
        }
    }
}
