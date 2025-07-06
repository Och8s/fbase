<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProExercici extends Model
{
    use HasFactory;

    protected $fillable = [
        'titol',
        'entrenador_id',
        'eina',
        'tasca_oberta',
        'fase_joc',
        'treball_tecnic',
        'treball_tactic',
        'treball_fisic',
        'treball_cognitiu',
        'espai',
        'durada_total',
        'durada_repeticio',
        'num_jugadors',
        'repeticions',
        'estat', // pendent, acceptat, rebutjat, publicat
    ];

    protected $casts = [
        'fase_joc' => 'array', // Per convertir automàticament en array (checkbox múltiples)
    ];

    // Relació amb entrenador (usuari)
    public function entrenador()
    {
        return $this->belongsTo(User::class, 'entrenador_id');
    }
}
