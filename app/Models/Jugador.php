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
    'num_mut',
    'met_pago',
    'conta_bancaria',
    'foto',
    'docu_extranger',
    'docu_complet',
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

public function rebuts()
{
    return $this->hasMany(Rebut::class);
}

// Relació amb la preinscripció (1 a 1, opcional)
// per dni
public function preinscripcio()
{
    return $this->hasOne(PreInscripcioJugador::class, 'dni', 'dni');
}


// Relació amb la documentació (1 a 1)
public function documentacio()
{
    return $this->hasOne(DocumentacioJugador::class);
}

}
