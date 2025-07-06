<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProExercici;

class ProExercicisController extends Controller
{
    public function index()
    {
        return ProExercici::all();
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
            'estat' => 'nullable|string|in:pendent,publicat,rebutjat',
            'espai' => 'nullable|string',
            'durada_total' => 'nullable|integer',
            'durada_repeticio' => 'nullable|integer',
            'num_jugadors' => 'nullable|integer',
            'repeticions' => 'nullable|integer',
        ]);

        if (!isset($validated['estat'])) {
            $validated['estat'] = 'pendent';
        }

        if (isset($validated['fases_joc'])) {
            $validated['fases_joc'] = json_encode($validated['fases_joc']);
        }

        $proExercici = ProExercici::create($validated);

        return response()->json($proExercici, 201);
    }

    public function show($id)
    {
        return ProExercici::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $proExercici = ProExercici::findOrFail($id);

        $validated = $request->validate([
            'entrenador_id' => 'sometimes|integer|exists:usuaris,id',
            'titol' => 'sometimes|required|string|max:255',
            'eina' => 'sometimes|required|string',
            'objectiu_principal' => 'nullable|string',
            'descripcio' => 'nullable|string',
            'dibuix' => 'nullable|string',
            'tasca_oberta' => 'nullable|integer|min:0|max:100',
            'treball_tecnic' => 'nullable|integer|min:0|max:100',
            'treball_tactic' => 'nullable|integer|min:0|max:100',
            'treball_fisic' => 'nullable|integer|min:0|max:100',
            'treball_cognitiu' => 'nullable|integer|min:0|max:100',
            'fases_joc' => 'nullable|array',
            'estat' => 'nullable|string|in:pendent,publicat,rebutjat',
            'espai' => 'nullable|string',
            'durada_total' => 'nullable|integer',
            'durada_repeticio' => 'nullable|integer',
            'num_jugadors' => 'nullable|integer',
            'repeticions' => 'nullable|integer',
        ]);

        if (isset($validated['fases_joc'])) {
            $validated['fases_joc'] = json_encode($validated['fases_joc']);
        }

        $proExercici->update($validated);

        return response()->json($proExercici);
    }

    public function destroy($id)
    {
        $proExercici = ProExercici::findOrFail($id);
        $proExercici->delete();

        return response()->json(['message' => 'Esborrat correctament']);
    }
}
