<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador2onEquip extends Model
{
    use HasFactory;

    protected $table = 'jugadors_2on_equip';

    protected $fillable = [
        'nom',
        'cognoms',
        'tipo_docu',
        'dni',
        'data_naixement',
        'dorsal',
        'telefon',
        'genere',
        'equip_id',
        'codi_fed',
        'num_mut',
        'foto',
        'docu_extranger',
        'docu_complet',
        'procedencia',
    ];

    protected $casts = [
        'docu_extranger' => 'boolean',
        'docu_complet' => 'boolean',
    ];
}
