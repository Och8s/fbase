<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Canvi extends Model
{
    use HasFactory;

    protected $fillable = [
        'partit_id',
        'jugador_entra_id',
        'jugador_surt_id',
        'minut',
    ];

    /**
     * Relación con el modelo Partit.
     * Un cambio pertenece a un partido.
     */
    public function partit()
    {
        return $this->belongsTo(Partit::class);
    }

    /**
     * Relación con el modelo Jugador.
     * Jugador que entra al campo.
     */
    public function jugadorEntra()
    {
        return $this->belongsTo(Jugador::class, 'jugador_entra_id');
    }

    /**
     * Relación con el modelo Jugador.
     * Jugador que sale del campo.
     */
    public function jugadorSurt()
    {
        return $this->belongsTo(Jugador::class, 'jugador_surt_id');
    }
}
