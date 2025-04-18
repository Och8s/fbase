<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'cognoms',
        'dni',
        'data_naixement',
        'dorsal',
        'equip_id',
    ];

    // Relación con Equip
    public function equip()
    {
        return $this->belongsTo(Equip::class);
    }

    // Relación con Usuarios (tutores)
    public function tutors()
    {
        return $this->belongsToMany(User::class, 'tutor_jugador', 'jugador_id', 'usuari_id');
    }
}
