<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Canvi;

class CanvisController extends Controller
{
    /**
     * Crear un canvi de jugador en un partit.
     */
    public function store(Request $request)
    {
        $request->validate([
            'partit_id' => 'required|exists:partits,id',
            'jugador_entra_id' => 'nullable|exists:jugadors,id', //  necessitem nullable per si no hi ha canvi
            'jugador_surt_id' => 'required|exists:jugadors,id',
            'minut' => 'required|integer|min:0|max:120',
        ]);

        $canvi = Canvi::create($request->only([
            'partit_id', 'jugador_entra_id', 'jugador_surt_id', 'minut'
        ]));

        return response()->json([
            'message' => 'Canvi registrat correctament',
            'canvi' => $canvi
        ], 201);
    }

    /**
     * Actualitzar un canvi concret.
     */
    public function update(Request $request, $id)
    {
        $canvi = Canvi::findOrFail($id);

        $request->validate([
            'jugador_entra_id' => 'nullable|exists:jugadors,id',
            'jugador_surt_id' => 'nullable|exists:jugadors,id',
            'minut' => 'nullable|integer|min:0|max:120',
        ]);

        $canvi->update($request->only([
            'jugador_entra_id', 'jugador_surt_id', 'minut'
        ]));

        return response()->json([
            'message' => 'Canvi actualitzat correctament',
            'canvi' => $canvi
        ]);
    }

    /**
     * Eliminar un canvi.
     */
    public function destroy($id)
    {
        $canvi = Canvi::findOrFail($id);
        $canvi->delete();

        return response()->json([
            'message' => 'Canvi eliminat correctament'
        ]);
    }

    public function deleteByPartit($partitId) // no usada
{
    Canvi::where('partit_id', $partitId)->delete();

    return response()->json([
        'message' => 'Tots els canvis del partit han estat eliminats correctament.'
    ]);
}

}
