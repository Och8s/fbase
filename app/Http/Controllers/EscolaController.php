<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Descripcio;
use App\Models\Equip;



class EscolaController extends Controller
{
    public function index()
    {
        return view('escola.index');
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
// App\Http\Controllers\EscolaController.php


public function equips()
{
    $equips = Equip::with('categoria', 'subcategoria')->get();

    return view('escola.equips', compact('equips'));
}

public function mostrarEquip($id)
{
    $equip = Equip::with([
        'categoria:id,nom',
        'subcategoria:id,nom',
        'modalitat:id,nom',
        'entrenador:id,name',
        'jugadors:id,nom,cognoms,dorsal,equip_id', // <- AÑADIDO
    ])->findOrFail($id);

    return view('escola.PlantillaEquipBase', compact('equip'));
}


}
