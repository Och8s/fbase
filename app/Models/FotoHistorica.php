<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoHistorica extends Model
{
    use HasFactory;

    protected $fillable = [
        'titol',
        'foto',
        'facilitador',
        'descripcio',
        'data',
        'lloc',
    ];
}
