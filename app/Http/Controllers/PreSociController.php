<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PreSoci;
use Illuminate\Http\Request;

class PreSociController extends Controller
{
    public function index()
    {
        return PreSoci::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pre_socis,email',
            'dni' => 'required|string|unique:pre_socis,dni',
            'data_naix' => 'nullable|date',
            'telefon' => 'nullable|string|max:20',
            'poblacio' => 'nullable|string|max:100',
            'adreca' => 'nullable|string|max:255',
            'numero_compte' => 'nullable|string|max:50',
        ]);

        $preSoci = PreSoci::create($validated);

        return response()->json($preSoci, 201);
    }

    public function show(PreSoci $preSoci)
    {
        return $preSoci;
    }

    public function update(Request $request, PreSoci $preSoci)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:pre_socis,email,' . $preSoci->id,
            'dni' => 'sometimes|string|unique:pre_socis,dni,' . $preSoci->id,
            'data_naix' => 'nullable|date',
            'telefon' => 'nullable|string|max:20',
            'poblacio' => 'nullable|string|max:100',
            'adreca' => 'nullable|string|max:255',
            'numero_compte' => 'nullable|string|max:50',
            'estat' => 'nullable|in:pendent,acceptat,rebutjat',
        ]);

        $preSoci->update($validated);

        return response()->json($preSoci);
    }

    public function destroy(PreSoci $preSoci)
    {
        $preSoci->delete();
        return response()->json(null, 204);
    }

    public function acceptar($id)
{
    $preSoci = PreSoci::findOrFail($id);
    $preSoci->estat = 'acceptat';
    $preSoci->save();

    return response()->json(['message' => 'Pre-soci acceptat', 'data' => $preSoci]);
}

public function rebutjar($id)
{
    $preSoci = PreSoci::findOrFail($id);
    $preSoci->estat = 'rebutjat';
    $preSoci->save();

    return response()->json(['message' => 'Pre-soci rebutjat', 'data' => $preSoci]);
}

}


