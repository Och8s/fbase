<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SegonEquipController extends Controller
{
    public function index()
{
    return view('segon_equip.index');
}

    public function plantilla()
    {
        return view('segon_equip.plantilla');
    }

    public function calendari()
    {
        return view('segon_equip.calendari');
    }

    public function jornada()
    {
        return view('segon_equip.jornada');
    }

    public function resultat()
    {
        return view('segon_equip.resultat');
    }

    public function classificacio()
    {
        return view('segon_equip.classificacio');
    }
}
