<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // <- AIXÒ ÉS CLAU!

class PreTecnificacio extends Model
{
    use HasFactory;

    protected $table = 'pre_tecnificacio';

   protected $fillable = [
    'nom', 'cognoms', 'dni', 'seg_social', 'data_naixement',
    'domicili', 'cp', 'telefon', 'email', 'nom_pares', 'num_compte',
    'consentiment_pares', 'drets_imatge', 'es_jugador_club', 'incapacitat', 'observacions',
    'estat', 'jugador_id'
];

    protected $casts = [
        'consentiment_pares' => 'boolean',
        'drets_imatge' => 'boolean',
        'es_jugador_club' => 'boolean',
    ];

    public function jugador()
    {
        return $this->belongsTo(Jugador::class, 'jugador_id');
    }
}

