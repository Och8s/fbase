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

public function estil()
{
    $descripcio = Descripcio::find(4);
    return view('escola.descripcioPlantilla', compact('descripcio'));
}
public function metodologia()
{
    $descripcio = Descripcio::find(5);
    return view('escola.descripcioPlantilla', compact('descripcio'));
}

}
