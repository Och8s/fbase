<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPorter extends Model
{
    use HasFactory;

    protected $table = 'events_porters';

    protected $fillable = [
        'titol',
        'descripcio',
        'data',
        'hora_inici',
        'hora_fi',
        'lloc',
        'categoria',
    ];
}
