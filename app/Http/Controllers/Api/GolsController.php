<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gol;

class GolsController extends Controller
{
    /**
     * Crear un nou gol per un partit.
     */
    public function store(Request $request)
    {
        $request->validate([
            'partit_id' => 'required|exists:partits,id',
            'jugador_id' => 'nullable|exists:jugadors,id',
            'minut' => 'required|integer|min:0|max:120',
            'tipo_gol' => 'required|in:favor,contra',
        ]);

        $gol = Gol::create($request->only([
            'partit_id', 'jugador_id', 'minut', 'tipo_gol'
        ]));

        return response()->json([
            'message' => 'Gol creat correctament',
            'gol' => $gol
        ], 201);
    }

    /**
     * Actualitzar un gol.
     */
    public function update(Request $request, $id)
    {
        $gol = Gol::findOrFail($id);

        $request->validate([
            'jugador_id' => 'nullable|exists:jugadors,id',
            'minut' => 'nullable|integer|min:0|max:120',
            'tipo_gol' => 'nullable|in:favor,contra',
        ]);

        $gol->update($request->only([
            'jugador_id', 'minut', 'tipo_gol'
        ]));

        return response()->json([
            'message' => 'Gol actualitzat correctament',
            'gol' => $gol
        ]);
    }

    /**
     * Eliminar un gol.
     */
    public function destroy($id)
    {
        $gol = Gol::findOrFail($id);
        $gol->delete();

        return response()->json([
            'message' => 'Gol eliminat correctament'
        ]);
    }
}
