<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rebut extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_rebut',
        'data_rebut',
        'jugador_id',
        'quantitat',
        'data_pagament',
        'pagat',
        'tipo_pago',
    ];

    // Relació amb el jugador
    public function jugador()
    {
        return $this->belongsTo(Jugador::class);
    }
}

