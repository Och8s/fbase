<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Descripcio;
use App\Models\EventPorter;
use App\Models\EntrenadorPorter;



class PortersController extends Controller
{
    public function index()
    {
        return view('porters.index');
    }


   public function metodologiaPorters()
{
    $descripcio = Descripcio::findOrFail(6); // o el id que corresponda
    return view('porters.descripcioPlantilla', compact('descripcio'));
}



public function horariCalendari()
{
    $events = EventPorter::orderBy('data', 'asc')->get();
    return view('porters.horariCalendari', compact('events'));
}

 public function entrenadors()
    {
        $entrenadors = EntrenadorPorter::select(
            'id', 'nom', 'cognoms', 'dni', 'telefon', 'equips', 'titulacio', 'foto', 'created_at', 'updated_at'
        )
        ->orderBy('nom')
        ->get();

        return view('porters.entrenadorsPorters', compact('entrenadors')); // Cambia a la vista correcta
    }

    public function plans()
    {
        return view('porters.plans');
    }

    public function contacte()
    {
        return view('porters.contacte');
    }
}
