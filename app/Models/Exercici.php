<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercici extends Model
{
    use HasFactory;

    protected $fillable = [
        'titol',
        'entrenador_id',
        'coordinador_id',
        'eina',
        'tasca_oberta',
        'fase_joc',
        'treball_tecnic',
        'treball_tactic',
        'treball_fisic',
        'treball_cognitiu',
        'espai',
        'durada_total',
        'durada_repeticio',
        'num_jugadors',
        'repeticions',
        'estat',
    ];

    protected $casts = [
        'fase_joc' => 'array',
    ];

    // Relació amb entrenador
    public function entrenador()
    {
        return $this->belongsTo(User::class, 'entrenador_id');
    }

    // Relació amb coordinador
    public function coordinador()
    {
        return $this->belongsTo(User::class, 'coordinador_id');
    }

    // Relació amb equips (pivot)
    public function equips()
    {
        return $this->belongsToMany(Equip::class, 'equip_exercici', 'exercici_id', 'equip_id');
    }
}
