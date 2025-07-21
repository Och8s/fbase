<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrimerEquipController extends Controller
{
    // Pàgina principal del 1r Equip
    public function index()
    {
        return view('primerEquip.index');
    }

    // Plantilla del 1r Equip
    public function plantilla()
    {
        return view('primerEquip.plantilla');
    }

    // Calendari de partits del 1r Equip
    public function calendari()
    {
        return view('primerEquip.calendari');
    }

    // Informació de la jornada actual
    public function jornada()
    {
        return view('primerEquip.jornada');
    }

    // Resultats dels partits
    public function resultats()
    {
        return view('primerEquip.resultats');
    }

    // Classificació de la lliga
    public function classificacio()
    {
        return view('primerEquip.classificacio');
    }
}
