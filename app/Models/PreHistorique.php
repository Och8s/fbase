<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class PreHistorique extends Model
{
    protected $table = 'pre_historiques';

    protected $fillable = [
        'titol',
        'foto',
        'facilitador',
        'descripcio',
        'data',
        'lloc',
        'estat',
    ];
}

