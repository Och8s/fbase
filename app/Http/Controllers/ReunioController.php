<?php

namespace App\Http\Controllers;

use App\Models\Reunio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReunioController extends Controller
{
    // 🔍 Llistar totes les reunions
    public function index()
    {
        return response()->json(
            Reunio::with(['usuaris', 'creador', 'equip'])->get()
        );
    }

    // ➕ Crear una nova reunió
    public function store(Request $request)
    {
        $data = $request->validate([
            'titol' => 'required|string|max:255',
            'equip_id' => 'nullable|exists:equips,id',
            'data' => 'required|date',
            'hora' => 'required',
            'lloc' => 'nullable|string|max:255',
            'continguts' => 'nullable|string',
            'acords' => 'nullable|string',
            'usuaris' => 'nullable|array',
            'usuaris.*' => 'exists:users,id', // 👈🏽 aquí canviat
        ]);

        // 🔐 Agafem l'usuari autenticat com a creador
        $data['creador_id'] = Auth::id();

        $reunio = Reunio::create($data);

        if (!empty($data['usuaris'])) {
            $reunio->usuaris()->sync($data['usuaris']);
        }

        return response()->json($reunio->load(['usuaris', 'creador', 'equip']), 201);
    }

    // 📄 Mostrar una reunió concreta
    public function show(Reunio $reunio)
    {
        return response()->json($reunio->load(['usuaris', 'creador', 'equip']));
    }

    // ✏️ Actualitzar reunió
    public function update(Request $request, Reunio $reunio)
    {
        $data = $request->validate([
            'titol' => 'sometimes|required|string|max:255',
            'equip_id' => 'nullable|exists:equips,id',
            'data' => 'sometimes|required|date',
            'hora' => 'sometimes|required',
            'lloc' => 'nullable|string|max:255',
            'continguts' => 'nullable|string',
            'acords' => 'nullable|string',
            'usuaris' => 'nullable|array',
            'usuaris.*' => 'exists:users,id', // 👈🏽 també aquí canviat
        ]);

        $reunio->update($data);

        if (isset($data['usuaris'])) {
            $reunio->usuaris()->sync($data['usuaris']);
        }

        return response()->json($reunio->load(['usuaris', 'creador', 'equip']));
    }

    // 🗑️ Eliminar reunió
    public function destroy(Reunio $reunio)
    {
        $reunio->delete();
        return response()->noContent();
    }
}
