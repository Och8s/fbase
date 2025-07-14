<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
class Jugador1erEquip extends Model
{
    use HasFactory;

    protected $table = 'jugadors_1er_equip';

    protected $fillable = [
        'nom',
        'cognoms',
        'tipo_docu',
        'dni',
        'data_naixement',
        'dorsal',
        'genere',
        'equip_id',
        'codi_fed',
        'num_mut',
        'foto',
        'docu_extranger',
        'docu_complet',
        'procedencia',
        'equips_anteriors',
    ];

    protected $casts = [
        'equips_anteriors' => 'array',
        'docu_extranger' => 'boolean',
        'docu_complet' => 'boolean',
    ];
}
