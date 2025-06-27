<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Subcategoria;

class SubcategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $subcategoriesPerCategoria = [
            'Babies' => ['sub5', 'sub6'],
            'Prebenjamín' => ['sub7', 'sub8'],
            'Benjamín' => ['sub9', 'sub10'],
            'Alevín' => ['sub11', 'sub12'],
            'Infantil' => ['sub13', 'sub14'],
            // Les altres categories no tenen subcategories de moment
        ];

        foreach ($subcategoriesPerCategoria as $nomCategoria => $subcategories) {
            $categoria = Categoria::where('nom', $nomCategoria)->first();

            if (!$categoria) {
                echo "⚠️ Categoria no trobada: $nomCategoria\n";
                continue;
            }

            foreach ($subcategories as $nomSubcat) {
                Subcategoria::create([
                    'nom' => $nomSubcat,
                    'categoria_id' => $categoria->id,
                ]);
                echo "✅ Afegida subcategoria '$nomSubcat' a '$nomCategoria'\n";
            }
        }
    }
}
