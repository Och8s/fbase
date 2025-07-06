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
            'nom' => 'required|string|max:255',
            'descripcio' => 'nullable|string',
            'pro_exercici_id' => 'required|exists:pro_exercicis,id',
            // afegeix altres camps si cal
        ]);

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
            'nom' => 'sometimes|required|string|max:255',
            'descripcio' => 'nullable|string',
            'pro_exercici_id' => 'sometimes|required|exists:pro_exercicis,id',
        ]);

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
