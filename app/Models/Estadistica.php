<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estadistica extends Model
{
    use HasFactory;

    protected $fillable = [
        'jugador_id',
        'partit_id',
        'partido_jugado',
        'titular',
        'gols_jugador',
        'minuts_jugats',
        'punts_equip_jjp',
        'punts_equip_jec',
        'gols_favor_jec',
        'gols_contra_jec',
        'dif_gols_jec',
    ];

    protected $casts = [
        'partido_jugado' => 'boolean',
        'titular' => 'boolean',
    ];

    public function jugador()
    {
        return $this->belongsTo(Jugador::class);
    }

    public function partit()
    {
        return $this->belongsTo(Partit::class);
    }
}
