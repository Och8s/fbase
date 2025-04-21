<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partit;

class PartitsController extends Controller
{
    /**
     * Llistar tots els partits (del club).
     */
    public function index()
    {
        $partits = Partit::with('equip')->get(); // afegim relació si cal
        return response()->json($partits);
    }

    /**
     * Mostrar un partit concret.
     */
    public function show($id)
{
    try {
        $partit = Partit::with(['gols', 'canvis', 'estadistiques'])->findOrFail($id);
        return response()->json($partit);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Error carregant el partit',
            'debug' => $e->getMessage(), // molt útil!
        ], 500);
    }
}


    /**s
     * Actualitzar dades del partit com entrandor (resultat, gols favor, contra, estat...).
     */
    public function updateEntrenador(Request $request, $id)
        {
            $request->validate([
                'gols_favor' => 'nullable|integer|min:0',
                'gols_contra' => 'nullable|integer|min:0',
                'partit_jugat' => 'nullable|boolean',
            ]);

            $partit = Partit::findOrFail($id);

            $partit->gols_favor = $request->input('gols_favor', $partit->gols_favor);
            $partit->gols_contra = $request->input('gols_contra', $partit->gols_contra);
            $partit->partit_jugat = $request->input('partit_jugat', $partit->partit_jugat);

            $partit->save();

            return response()->json([
                'message' => 'Partit actualitzat per l\'entrenador',
                'partit' => $partit
            ]);
}



    // Per quan tinquem gestio per Admin
    /**
 * Actualitzar un partit complet (només admins/secretaria).
 * No utilitzat encara, però preparat per a gestió futura.
 */
    public function updateAdmin(Request $request, $id)
    {
        // Validació per a tots els camps
        $validated = $request->validate([
            'equip_id' => 'required|exists:equips,id',
            'rival' => 'required|string|max:255',
            'data' => 'required|date',
            'local' => 'required|boolean',
            'jornada' => 'required|integer',
            'gols_favor' => 'nullable|integer|min:0',
            'gols_contra' => 'nullable|integer|min:0',
            'partit_jugat' => 'required|boolean',
        ]);

        $partit = Partit::findOrFail($id);
        $partit->update($validated);

        return response()->json(['message' => 'Partit actualitzat completament', 'partit' => $partit]);
    }

}
