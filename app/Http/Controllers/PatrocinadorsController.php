<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patrocinador;

class PatrocinadorsController extends Controller
{
    /**
     * Mostrar tots els patrocinadors
     */
    public function index()
    {
        $patrocinadors = Patrocinador::all();
        return view('patrocinadors.index', compact('patrocinadors'));
    }

    /**
     * Mostrar un patrocinador en concret
     */
    public function mostra($id)
    {
        $patrocinador = Patrocinador::findOrFail($id);
        return view('patrocinadors.mostra', compact('patrocinador'));
    }

    /**
     * Formulari de creació
     */
    public function create()
    {
        return view('patrocinadors.create');
    }

    /**
     * Guardar patrocinador nou
     */
    public function store(Request $request)
    {
        $dades = $request->validate([
            'nom' => 'required|string|max:255',
            'logo' => 'nullable|image',
            'enllac_web' => 'nullable|url',
        ]);

        if ($request->hasFile('logo')) {
            $dades['logo'] = $request->file('logo')->store('images/patrocinadors', 'public');
        }

        Patrocinador::create($dades);
        return redirect()->route('patrocinadors.index')->with('success', 'Patrocinador afegit correctament.');
    }
}
