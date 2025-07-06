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
            'nom' => 'required|string|max:255',
            'descripcio' => 'nullable|string',
            // afegeix altres camps si cal
        ]);

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
            'nom' => 'sometimes|required|string|max:255',
            'descripcio' => 'nullable|string',
            // afegeix altres camps si cal
        ]);

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
