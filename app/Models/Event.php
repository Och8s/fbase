<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'titol',
        'descripcio',
        'foto',
        'data_inici',
        'data_final',
        'horari',
        'preu',
        'action_type',  // <-- Afegeix aquí
    ];
}
