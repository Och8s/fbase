<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Estadistica;

class EstadistiquesController extends Controller
{
    /**
     * Crear una nova estadística per un jugador i partit.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jugador_id' => 'required|exists:jugadors,id',
            'partit_id' => 'required|exists:partits,id',
            'partido_jugado' => 'required|boolean',
            'titular' => 'required|boolean',
            'gols_jugador' => 'nullable|integer|min:0',
            'minuts_jugats' => 'nullable|integer|min:0',
            'punts_equip_jjp' => 'nullable|integer',
            'punts_equip_jec' => 'nullable|integer',
            'gols_favor_jec' => 'nullable|integer',
            'gols_contra_jec' => 'nullable|integer',
            'dif_gols_jec' => 'nullable|integer',
        ]);

        $estadistica = Estadistica::create($request->only([
            'jugador_id', 'partit_id', 'partido_jugado', 'titular',
            'gols_jugador', 'minuts_jugats',
            'punts_equip_jjp', 'punts_equip_jec',
            'gols_favor_jec', 'gols_contra_jec', 'dif_gols_jec'
        ]));

        return response()->json([
            'message' => 'Estadística creada correctament',
            'estadistica' => $estadistica
        ], 201);
    }

    /**
     * Actualitzar una estadística concreta.
     */
    public function update(Request $request, $id)
    {
        $estadistica = Estadistica::findOrFail($id);

        $request->validate([
            'partido_jugado' => 'required|boolean',
            'titular' => 'required|boolean',
            'gols_jugador' => 'nullable|integer|min:0',
            'minuts_jugats' => 'nullable|integer|min:0',
            'punts_equip_jjp' => 'nullable|integer',
            'punts_equip_jec' => 'nullable|integer',
            'gols_favor_jec' => 'nullable|integer',
            'gols_contra_jec' => 'nullable|integer',
            'dif_gols_jec' => 'nullable|integer',
        ]);

        $estadistica->update($request->only([
            'partido_jugado', 'titular',
            'gols_jugador', 'minuts_jugats',
            'punts_equip_jjp', 'punts_equip_jec',
            'gols_favor_jec', 'gols_contra_jec', 'dif_gols_jec'
        ]));

        return response()->json([
            'message' => 'Estadística actualitzada correctament',
            'estadistica' => $estadistica
        ]);
    }

    /**
     * Eliminar una estadística concreta.
     */
    public function destroy($id)
    {
        $estadistica = Estadistica::findOrFail($id);
        $estadistica->delete();

        return response()->json([
            'message' => 'Estadística eliminada correctament'
        ]);
    }
}
