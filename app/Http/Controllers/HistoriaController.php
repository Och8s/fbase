<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Descripcio;
use App\Models\ExitEsportiu;



class HistoriaController extends Controller
{
    public function index()
    {
        return view('historia.index');
    }

    public function ressenya()
    {
        // Canvia l'ID segons el registre que vulguis mostrar
        $descripcio = Descripcio::find(7);

        return view('historia.descripcioPlantilla', compact('descripcio'));
    }


    public function cronologia()
    {
        // Només ACTIUS, dins el rang d'anys, ordenats per any desc i màxim 12
        $exits = ExitEsportiu::where('actiu', true)
            ->whereBetween('data', [1969, 2024])   // si 'data' és YEAR
            ->orderBy('data', 'desc')
            ->take(12)
            ->get();

        // Omplim fins a 12 targetes amb placeholders buits
        $faltants = 12 - $exits->count();
        for ($i = 0; $i < $faltants; $i++) {
            $exits->push(new ExitEsportiu([
                'titol' => '',
                'foto' => '',
                'descripcio' => '',
                'data' => null,
                'actiu' => false,
            ]));
        }

        return view('historia.cronologia', compact('exits'));
    }

    public function fotografies()
    {
        return view('historia.fotografies');
    }

    public function envians()
    {
        return view('historia.envians');
    }
}
