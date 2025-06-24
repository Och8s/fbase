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
    'tipo_docu',
    'dni',
    'data_naixement',
    'dorsal',
    'genere',
    'equip_id',
    'codi_fed',
    'docu_extranger',
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

    public function estadistiques()
    {
        return $this->hasMany(Estadistica::class);
    }

    public function canvisEntrant()
    {
        return $this->hasMany(Canvi::class, 'jugador_entra_id');
    }

    public function canvisSortint()
    {
        return $this->hasMany(Canvi::class, 'jugador_surt_id');
    }

    public function canvis()
    {
        return $this->canvisEntrant->merge($this->canvisSortint);
    }

    public function gols()
    {
        return $this->hasMany(Gol::class);
    }



}
