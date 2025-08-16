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
    $exits = ExitEsportiu::where('actiu', true)
        ->whereYear('data', '>=', 1966)
        ->whereYear('data', '<=', 2024)
        ->inRandomOrder()      // coge 12 al azar
        ->take(12)
        ->get()
        ->sortByDesc('data');  // y los muestra ordenados por fecha

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
