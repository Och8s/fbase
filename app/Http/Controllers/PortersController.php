<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Descripcio;
use App\Models\EventPorter;


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
        return view('porters.entrenadors');
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
