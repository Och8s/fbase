<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exercici;

class ExercicisController extends Controller
{
    public function index()
    {
        return Exercici::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'entrenador_id' => 'required|integer|exists:usuaris,id',
            'titol' => 'required|string|max:255',
            'eina' => 'required|string',
            'objectiu_principal' => 'nullable|string',
            'descripcio' => 'nullable|string',
            'dibuix' => 'nullable|string',
            'tasca_oberta' => 'nullable|integer|min:0|max:100',
            'treball_tecnic' => 'nullable|integer|min:0|max:100',
            'treball_tactic' => 'nullable|integer|min:0|max:100',
            'treball_fisic' => 'nullable|integer|min:0|max:100',
            'treball_cognitiu' => 'nullable|integer|min:0|max:100',
            'fases_joc' => 'nullable|array',
            'espai' => 'nullable|string',
            'durada_total' => 'nullable|integer',
            'durada_repeticio' => 'nullable|integer',
            'num_jugadors' => 'nullable|integer',
            'repeticions' => 'nullable|integer',
        ]);

        if (isset($validated['fases_joc'])) {
            $validated['fases_joc'] = json_encode($validated['fases_joc']);
        }

        $exercici = Exercici::create($validated);

        return response()->json($exercici, 201);
    }

    public function show($id)
    {
        return Exercici::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $exercici = Exercici::findOrFail($id);

        $validated = $request->validate([
            'titol' => 'sometimes|required|string|max:255',
            'objectiu_principal' => 'nullable|string',
            'descripcio' => 'nullable|string',
            'tasca_oberta' => 'nullable|integer|min:0|max:100',
            'treball_tecnic' => 'nullable|integer|min:0|max:100',
            'treball_tactic' => 'nullable|integer|min:0|max:100',
            'treball_fisic' => 'nullable|integer|min:0|max:100',
            'treball_cognitiu' => 'nullable|integer|min:0|max:100',
            'fases_joc' => 'nullable|array',
            'espai' => 'nullable|string',
            'durada_total' => 'nullable|integer',
            'durada_repeticio' => 'nullable|integer',
            'num_jugadors' => 'nullable|integer',
            'repeticions' => 'nullable|integer',
        ]);

        if (isset($validated['fases_joc'])) {
            $validated['fases_joc'] = json_encode($validated['fases_joc']);
        }

        $exercici->update($validated);

        return response()->json($exercici);
    }

    public function destroy($id)
    {
        $exercici = Exercici::findOrFail($id);
        $exercici->delete();

        return response()->json(['message' => 'Esborrat correctament']);
    }
}
