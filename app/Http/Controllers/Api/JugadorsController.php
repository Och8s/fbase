<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jugador;
use App\Models\Estadistica;
use App\Models\Partit;



class JugadorsController extends Controller
{
    /**
     * Vista per a entrenadors: estadístiques detallades del jugador.
     */
    public function vistaEntrenador($id)
    {
        // Obtenim el jugador pel seu ID o llencem error si no existeix
        $jugador = Jugador::findOrFail($id);

        // Busquem totes les estadístiques associades a aquest jugador
        // I afegim la informació del partit relacionat amb cada estadística
        $estadistiques = Estadistica::where('jugador_id', $id)
            ->with('partit') // inclou info del partit com rival, data, etc.
            ->get();

        // Retornem la resposta en format JSON amb les dades del jugador i les estadístiques detallades
        return response()->json([
            'jugador' => $jugador,
            'estadistiques' => $estadistiques
        ]);
    }

    /**
     * Vista per a tutors: resum acumulat de les estadístiques del jugador.
     */
    public function vistaTutor($id)
    {
        $jugador = Jugador::with('equip')->findOrFail($id);

        $estadistiques = Estadistica::where('jugador_id', $id)->get();

        if ($estadistiques->isEmpty()) {
            return response()->json([
                'jugador' => $jugador,
                'resum' => 'Aquest jugador encara no té estadístiques.'
            ]);
        }

        $equipId = $jugador->equip_id;

        // Tots els partits d'aquest equip
        $partitsEquip = Partit::where('equip_id', $equipId)->get();

        // FILTRATS
        $ambPresencia = $estadistiques->where('partido_jugado', true);
        $titulars = $estadistiques->where('titular', true);
        $minutsTotals = $estadistiques->sum('minuts_jugats');
        $golsJugador = $estadistiques->sum('gols_jugador');

        // PARTITS amb el jugador (per ID de partit)
        $idsPartitsAmbJugador = $ambPresencia->pluck('partit_id')->unique();
        $partitsAmbJugador = $partitsEquip->whereIn('id', $idsPartitsAmbJugador);

        // MITJANES PUNTS
        $mitjanaPuntsAmbJugador = $ambPresencia->avg('punts_equip_jjp') ?? 0;
        $mitjanaPuntsTitular = $titulars->avg('punts_equip_jjp') ?? 0;
        $mitjanaPuntsCamp = $estadistiques->avg('punts_equip_jec') ?? 0;
        $mitjanaPuntsEquip = $partitsEquip->count() > 0 ? $partitsEquip->sum('resultat') / $partitsEquip->count() : 0;

        // GOLS MARCATS I REBUTS AMB JUGADOR AL CAMP
        $golsFavorAmb = $estadistiques->sum('gols_favor_jec');
        $golsContraAmb = $estadistiques->sum('gols_contra_jec');
        $difGolsAmb = $estadistiques->sum('dif_gols_jec');

        // COMPARATIVA GOLS MITJANA AMB I SENSE EL JUGADOR
        $partitsSenseJugador = $partitsEquip->whereNotIn('id', $idsPartitsAmbJugador);

        $mitjanaGolsAmbJugador = $partitsAmbJugador->count() > 0
            ? $partitsAmbJugador->sum('gols_favor') / $partitsAmbJugador->count()
            : 0;

        $mitjanaGolsSenseJugador = $partitsSenseJugador->count() > 0
            ? $partitsSenseJugador->sum('gols_favor') / $partitsSenseJugador->count()
            : 0;

        $mitjanaGolsRebutsAmbJugador = $partitsAmbJugador->count() > 0
            ? $partitsAmbJugador->sum('gols_contra') / $partitsAmbJugador->count()
            : 0;

        $mitjanaGolsRebutsSenseJugador = $partitsSenseJugador->count() > 0
            ? $partitsSenseJugador->sum('gols_contra') / $partitsSenseJugador->count()
            : 0;

        // MINUTS PER GOL
        $minutsPerGol = ($golsJugador > 0 && $minutsTotals > 0)
            ? round($minutsTotals / $golsJugador, 2)
            : null;

        return response()->json([
            'jugador' => $jugador,
            'resum' => [
                'mitjana_punts_presencia' => round($mitjanaPuntsAmbJugador, 2),
                'mitjana_punts_titular' => round($mitjanaPuntsTitular, 2),
                'mitjana_punts_camp' => round($mitjanaPuntsCamp, 2),
                'mitjana_punts_equip' => round($mitjanaPuntsEquip, 2),

                'gols_jugador' => $golsJugador,
                'minuts_per_gol' => $minutsPerGol,

                'gols_favor_jec' => $golsFavorAmb,
                'gols_contra_jec' => $golsContraAmb,
                'dif_gols_jec' => $difGolsAmb,

                'mitjana_gols_partit_amb' => round($mitjanaGolsAmbJugador, 2),
                'mitjana_gols_partit_sense' => round($mitjanaGolsSenseJugador, 2),

                'mitjana_gols_rebuts_amb' => round($mitjanaGolsRebutsAmbJugador, 2),
                'mitjana_gols_rebuts_sense' => round($mitjanaGolsRebutsSenseJugador, 2),
            ]
        ]);
    }

}
