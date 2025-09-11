<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jugador1erEquip;


class PrimerEquipController extends Controller
{
    // Pàgina principal del 1r Equip
    public function index()
    {
        return view('primerEquip.index');
    }


    public function plantilla()
    {
        // Ajusta l’ID del primer equip si cal (ENV opcional)
        $equipId = (int) env('PRIMER_EQUIP_ID', 36);

        $jugadors = Jugador1erEquip::where('equip_id', $equipId)
            ->orderByRaw('COALESCE(dorsal, 9999), cognoms, nom')
            ->get();

        // IMPORTANT: apuntem a la vista que has creat
        return view('primerEquip.plantilla1equip', compact('jugadors'));
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
