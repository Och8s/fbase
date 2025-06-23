<?php

namespace App\Http\Controllers;

use App\Mail\InformeJugadorMail;
use App\Models\Jugador;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function enviarInformeJugador($id)
    {
        $jugador = Jugador::with('equip', 'tutors')->findOrFail($id);

        $estadistiques = $this->calcularResumJugador($jugador);

        $correusEnviats = [];

        foreach ($jugador->tutors as $tutor) {
            if ($tutor->email) {
                Mail::to($tutor->email)->send(new InformeJugadorMail($jugador, $estadistiques));
                $correusEnviats[] = $tutor->email;
            }
        }

        if (count($correusEnviats) > 0) {
            return back()->with('success', 'Informe enviat als tutors: ' . implode(', ', $correusEnviats));
        }

        return back()->with('error', 'Cap tutor té correu electrònic associat.');
    }

    public function enviarInformesEquip($equipId)
{
    $jugadors = Jugador::with('equip', 'tutors', 'estadistiques')
        ->where('equip_id', $equipId)
        ->get();

    $correusTotals = 0;
    $correusEnviats = [];

    foreach ($jugadors as $jugador) {
        $estadistiques = $this->calcularResumJugador($jugador);

        foreach ($jugador->tutors as $tutor) {
            if ($tutor->email) {
                Mail::to($tutor->email)->send(new InformeJugadorMail($jugador, $estadistiques));
                $correusEnviats[] = $tutor->email;
                $correusTotals++;
            }
        }
    }

    if ($correusTotals > 0) {
        return back()->with('success', "S'han enviat $correusTotals informes als tutors de l'equip.");
    }

    return back()->with('error', 'Cap tutor de l’equip té correu electrònic associat.');
}

    public function calcularResumJugador($jugador)
    {
        $estadistiques = $jugador->estadistiques;
        $partits = \App\Models\Partit::where('equip_id', $jugador->equip_id)
            ->where('partit_jugat', true)
            ->get();

        $totalPartits = $estadistiques->where('partido_jugado', true)->count();
        $titulars = $estadistiques->where('titular', true)->count();
        $minuts = $estadistiques->sum('minuts_jugats');
        $gols = $estadistiques->sum('gols_jugador');

        $minutsXPartit = $totalPartits > 0 ? round($minuts / $totalPartits, 2) : null;
        $minutsEquip = $partits->count() * 95;
        $percentatgeMinuts = $minutsEquip > 0 ? round(($minuts / $minutsEquip) * 100, 2) : null;

        $mitjana_jjp = $totalPartits > 0 ? round($estadistiques->avg('punts_equip_jjp'), 2) : null;
        $mitjana_jec = $totalPartits > 0 ? round($estadistiques->avg('punts_equip_jec'), 2) : null;
        $mitjana_jjp_titular = $titulars > 0 ? round($estadistiques->where('titular', true)->avg('punts_equip_jjp'), 2) : null;

        $puntsEquip = $partits->reduce(function ($carry, $partit) {
            return $carry + ($partit->gols_favor > $partit->gols_contra ? 3 : ($partit->gols_favor == $partit->gols_contra ? 1 : 0));
        }, 0);
        $mitjana_total_equip = $partits->count() > 0 ? round($puntsEquip / $partits->count(), 2) : null;

        $minuts_per_gol = $gols > 0 ? round($minuts / $gols, 2) : null;

        $gols_favor_amb = $estadistiques->sum('gols_favor_jec');
        $gols_contra_amb = $estadistiques->sum('gols_contra_jec');
        $diferencia_gols = $estadistiques->sum('dif_gols_jec');

        // 🔍 Comparatives extra
        $mitjana_gols_favor_equip = $partits->count() > 0
            ? round($partits->sum('gols_favor') / $partits->count(), 2)
            : null;

        $mitjana_gols_contra_equip = $partits->count() > 0
            ? round($partits->sum('gols_contra') / $partits->count(), 2)
            : null;

        $mitjana_gols_favor_amb = $minuts > 0
            ? round(($gols_favor_amb * 95) / $minuts, 2)
            : null;

        $mitjana_gols_contra_amb = $minuts > 0
            ? round(($gols_contra_amb * 95) / $minuts, 2)
            : null;

        // Valoració automàtica
        $valoracio = 'Sense dades suficients';

        if ($totalPartits >= 2) {
            if ($percentatgeMinuts >= 90 && $gols >= 2 && $mitjana_jec >= 2.2) {
                $valoracio = 'Jugador clau de l’equip';
            } elseif ($percentatgeMinuts >= 70 && $mitjana_jec >= 1.7) {
                $valoracio = 'Bon rendiment general, pot arribar a ser un jugador clau';
            } elseif ($percentatgeMinuts < 50) {
                $valoracio = 'Participació mitja, está molt a prop de tenir un rendiment óptim';
            } else {
                $valoracio = 'Ha de seguir millorant i aprenent';
            }
        }


        return [
            'partits_jugats' => $totalPartits,
            'titularitats' => $titulars,
            'minuts_jugats' => $minuts,
            'minuts_jugatsXpartit' => $minutsXPartit,
            'percentatge_minuts' => $percentatgeMinuts,

            'gols' => $gols,
            'minuts_per_gol' => $minuts_per_gol,
            'gols_favor_amb' => $gols_favor_amb,
            'gols_contra_amb' => $gols_contra_amb,
            'diferencia_gols' => $diferencia_gols,
            'mitjana_gols_favor_amb' => $mitjana_gols_favor_amb,
            'mitjana_gols_contra_amb' => $mitjana_gols_contra_amb,
            'mitjana_gols_favor_equip' => $mitjana_gols_favor_equip,
            'mitjana_gols_contra_equip' => $mitjana_gols_contra_equip,

            'mitjana_jjp' => $mitjana_jjp,
            'mitjana_jec' => $mitjana_jec,
            'mitjana_jjp_titular' => $mitjana_jjp_titular,
            'mitjana_total_equip' => $mitjana_total_equip,
            'valoracio' => $valoracio,
        ];
    }
}
