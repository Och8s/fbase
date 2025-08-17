<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JugadorHistoric extends Model
{
    // (opcional si segueixes el conveni) però el deixo explícit
    protected $table = 'jugadors_historics';

    // Camps que admeten assignació massiva
    protected $fillable = [
        'nom',
        'cognoms',
        'apodo',
        'foto',
        'posicio',
        'etapa_curta',
        'descripcio_curta',
        'descripcio_llarga',
        'actiu',
        'ordre',
    ];

    // Castejats útils
    protected $casts = [
        'actiu' => 'boolean',
        'ordre' => 'integer',
    ];

    // (opc.) Accessor curt per mostrar “Nom Cognoms” + sobrenom
    public function getNomComplertAttribute(): string
    {
        $nom = trim($this->nom.' '.$this->cognoms);
        return $this->apodo ? $nom.' "'.$this->apodo.'"' : $nom;
    }
}
