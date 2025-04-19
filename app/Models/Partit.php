<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Partit extends Model
{
    protected $fillable = [
        'equip_id',
        'rival',
        'data',
        'local',
        'jornada',
        'gols_favor',
        'gols_contra',
        'partit_jugat',
    ];

    protected $casts = [
        'local' => 'boolean',
        'partit_jugat' => 'boolean',
        'data' => 'date',
    ];

    public function equip(): BelongsTo
    {
        return $this->belongsTo(Equip::class);
    }

    public function estadistiques()
    {
        return $this->hasMany(Estadistica::class);
    }

    public function canvis()
    {
        return $this->hasMany(Canvi::class);
    }

    public function gols()
    {
        return $this->hasMany(Gol::class);
    }


}
