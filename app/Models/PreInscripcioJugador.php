<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreInscripcioJugador extends Model
{
    protected $table = 'pre_inscripcio_jugadors';

    protected $fillable = [
        'nom', 'cognoms', 'dni', 'seg_social', 'data_naixement',
        'domicili', 'cp', 'telefon', 'nom_pares', 'num_compte',
        'consentiment_pares', 'drets_imatge', 'intolerancia',
        'incapacitat', 'es_jugador_club', 'separats', 'tipus_custodia',
        'estat'
    ];

    protected $casts = [
        'nom_pares' => 'array',
        'consentiment_pares' => 'boolean',
        'drets_imatge' => 'boolean',
        'es_jugador_club' => 'boolean',
        'separats' => 'boolean',
    ];

    // Opcional: relació amb jugador si s'arriba a crear
    public function jugador()
    {
        return $this->hasOne(Jugador::class, 'dni', 'dni'); // si coincideix pel DNI
    }
}

