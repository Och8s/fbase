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
            $nomArxiu = str_replace(' ', '_', strtolower($request->nom)); // ex: "Coca Cola" → "coca_cola"
            $extensio = $request->file('logo')->getClientOriginalExtension(); // jpg, png, etc.
            $nomFitxerFinal = $nomArxiu . '.' . $extensio;

            $request->file('logo')->move(public_path('images/patrocinadors'), $nomFitxerFinal);

            $dades['logo'] = $nomFitxerFinal;
        }


        Patrocinador::create($dades);
        return redirect()->route('patrocinadors.index')->with('success', 'Patrocinador afegit correctament.');
    }
}
