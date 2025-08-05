<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Descripcio;


class EscolaController extends Controller
{
    public function index()
    {
        return view('escola.index');
    }



    public function equips()
    {
        return view('escola.equips');
    }

    public function estil()
    {
        return view('escola.estil');
    }

    public function metodologia()
    {
        return view('escola.metodologia');
    }

    public function accesEntrenador()
    {
        return view('escola.accesEntrenador');
    }

    public function accesCoordinador()
    {
        return view('escola.accesCoordinador');
    }

    // PLANTILLA ESCOLA COPIA DE CLUB, PARA QUE NO DE PROBLEMAS LOCALITZACIÓ
public function formacio()
{
    $descripcio = Descripcio::find(3); // o el que correspongui
    return view('escola.descripcioPlantilla', compact('descripcio'));
}
}
