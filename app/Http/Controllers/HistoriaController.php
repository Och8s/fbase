<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Descripcio;
use App\Models\ExitEsportiu;
use App\Models\FotoHistorica;



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

// app/Http/Controllers/HistoriaController.php
public function jugadors()
{
    $jugadors = \App\Models\JugadorHistoric::where('actiu', true)
        ->inRandomOrder()   // els agafa a l’atzar
        ->take(14)          // només 14 (5+4+5)
        ->get();

    return view('historia.jugadorsHistorics', compact('jugadors'));
}

    public function fotografies()
{
    $fotos = FotoHistorica::orderBy('data', 'asc')->get();
    return view('historia.fotografies', compact('fotos'));
}

    public function envians()
    {
        return view('historia.envians');
    }
}
