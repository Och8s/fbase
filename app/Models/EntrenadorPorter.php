<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntrenadorPorter extends Model
{
    use HasFactory;

    protected $table = 'entrenadors_porters';

    protected $fillable = [
        'nom',
        'cognoms',
        'dni',
        'telefon',
        'equips',
        'titulacio',
        'foto',
    ];
}

