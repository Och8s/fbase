<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gol extends Model
{
    use HasFactory;

    protected $fillable = [
        'partit_id',
        'jugador_id',
        'minut',
        'tipo_gol',
    ];

    /**
     * Relación con el modelo Partit.
     * Un gol pertenece a un partido.
     */
    public function partit()
    {
        return $this->belongsTo(Partit::class);
    }

    /**
     * Relación con el modelo Jugador.
     * Un gol puede pertenecer a un jugador (nullable).
     */
    public function jugador()
    {
        return $this->belongsTo(Jugador::class);
    }
}

// $gol->partit->rival;         // veure contra qui es va jugar
// $gol->jugador?->nom;         // accedir al nom del jugador (si n'hi ha)
