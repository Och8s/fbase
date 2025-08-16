<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Descripcio;


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
        return view('historia.cronologia');
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
