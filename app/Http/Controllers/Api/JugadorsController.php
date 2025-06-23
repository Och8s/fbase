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
        $partitsEquip = Partit::where('equip_id', $equipId)->get();

        // PARTICIPACIÓ
        $partitsJugats = $estadistiques->where('partido_jugado', true)->count();
        $partitsTitular = $estadistiques->where('titular', true)->count();
        $minutsTotals = $estadistiques->sum('minuts_jugats');
        $minutsPerPartit = $partitsJugats > 0 ? round($minutsTotals / $partitsJugats, 2) : null;
        $partitsJugatsEquip = $partitsEquip->where('partit_jugat', true)->count();
        $minutsEquipTotals = $partitsJugatsEquip * 95;
        $percentatgeMinuts = $minutsEquipTotals > 0
            ? round(($minutsTotals / $minutsEquipTotals) * 100, 2)
            : null;

        // MITJANES DE PUNTS

        // MITJANA DE PUNTS presnencia
        $puntsPresencia = $estadistiques->where('partido_jugado', true)->sum('punts_equip_jjp');
        $mitjanaPuntsPresencia = $partitsJugats > 0
            ? round($puntsPresencia / $partitsJugats, 2)
            : null;

        $puntsPresenciaTitular = $estadistiques->where('titular', true)->sum('punts_equip_jjp');
        $mitjanaPuntsPresenciaTitular = $partitsTitular > 0
                ? round($puntsPresenciaTitular / $partitsTitular, 2)
                : null;

        $puntsPresenciaAlCamp = $estadistiques->where('partido_jugado', true)->sum('punts_equip_jec');
        $mitjanaPuntsPresenciaAlCamp = $partitsJugats > 0
                    ? round($puntsPresenciaAlCamp / $partitsJugats, 2)
                    : null;

       $partitsJugatsEquipats = $partitsEquip->where('partit_jugat', true);
        // Calcular punts totals com en una lliga real
        $puntsEquip = $partitsJugatsEquipats->reduce(function ($carry, $partit) {
            if ($partit->gols_favor > $partit->gols_contra) {
                return $carry + 3;
            } elseif ($partit->gols_favor == $partit->gols_contra) {
                return $carry + 1;
            } else {
                return $carry;
            }
        }, 0);

        // Mitjana per partit
        $mitjanaPuntsEquip = $partitsJugatsEquipats->count() > 0
            ? round($puntsEquip / $partitsJugatsEquipats->count(), 2)
            : null;

        // GOLS
        $golsJugador = $estadistiques->sum('gols_jugador');
        $minutsPerGol = ($golsJugador > 0 && $minutsTotals > 0)
            ? round($minutsTotals / $golsJugador, 2)
            : null;

        $golsFavorAmb = $estadistiques->sum('gols_favor_jec');
        $golsContraAmb = $estadistiques->sum('gols_contra_jec');
        $difGolsAmb = $estadistiques->sum('dif_gols_jec');

        // COMPARATIVA
        $mitjanaGolsAmbJugador = ($minutsTotals > 0)
        ? round(($golsFavorAmb * 95) / $minutsTotals, 2)
        : null;

        $mitjanaGolsRebutsAmb = ($minutsTotals > 0)
        ? round(($golsContraAmb * 95) / $minutsTotals, 2)
        : null;

        $mitjanaGolsFavorEquip = $partitsJugatsEquipats->count() > 0
        ? round($partitsJugatsEquipats->sum('gols_favor') / $partitsJugatsEquipats->count(), 2)
        : null;

    $mitjanaGolsContraEquip = $partitsJugatsEquipats->count() > 0
        ? round($partitsJugatsEquipats->sum('gols_contra') / $partitsJugatsEquipats->count(), 2)
        : null;




        return response()->json([
            'jugador' => $jugador,
            'resum' => [
                'partits_jugats' => $partitsJugats,
                'partits_titular' => $partitsTitular,
                'minuts_totals' => $minutsTotals,
                'minuts_per_partit' => $minutsPerPartit,
                'percentatge_minuts' => $percentatgeMinuts,

                'mitjana_punts_presencia' => $mitjanaPuntsPresencia,
                'mitjana_punts_titular' => $mitjanaPuntsPresenciaTitular,
                'mitjana_punts_camp' => $mitjanaPuntsPresenciaAlCamp,
                'mitjana_punts_equip' => $mitjanaPuntsEquip,

                'gols_jugador' => $golsJugador,
                'minuts_per_gol' => $minutsPerGol,
                'gols_favor_jec' => $golsFavorAmb,
                'gols_contra_jec' => $golsContraAmb,
                'dif_gols_jec' => $difGolsAmb,

                'mitjana_gols_partit_amb' => $mitjanaGolsAmbJugador,
                'mitjana_gols_favor_equip' => $mitjanaGolsFavorEquip,
                'mitjana_gols_rebuts_amb' => $mitjanaGolsRebutsAmb,
                'mitjana_gols_contra_equip' => $mitjanaGolsContraEquip,
            ]
        ]);
    }

    public function jugadorsAmbEstadistiques($equipId)
{
    $jugadors = \App\Models\Jugador::where('equip_id', $equipId)
        ->with(['estadistiques.partit']) // carrega estadístiques i els seus partits
        ->get();

    return response()->json($jugadors);
}


}
