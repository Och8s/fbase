<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SegonEquipController extends Controller
{
    public function index()
    {
        return view('segonEquip.index');
    }

    public function plantilla()
    {
        return view('segonEquip.plantilla');
    }

    public function calendari()
    {
        return view('segonEquip.calendari');
    }

    public function jornada()
    {
        return view('segonEquip.jornada');
    }

    public function resultats()
    {
        return view('segonEquip.resultats');
    }

    public function classificacio()
    {
        return view('segonEquip.classificacio');
    }
}
