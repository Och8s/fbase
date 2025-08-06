<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Jugador;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equip extends Model
{
    use HasFactory;

protected $fillable = [
    'nom',
    'categoria_id',
    'subcategoria_id',
    'entrenador_id',
    'divisio',
    'grup',
    'codi_fed',
    'modalitat_id', // 👈 Afegeix aquest!
];



    public function partits(): HasMany
    {
        return $this->hasMany(Partit::class);
    }

    public function entrenador()
    {
        return $this->belongsTo(User::class, 'entrenador_id');
    }

    public function jugadors()
    {
        return $this->hasMany(Jugador::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }
    public function horaris()
{
    return $this->hasMany(Horari::class);
}
public function modalitat()
{
    return $this->belongsTo(Modalitat::class);
}


    // Relació molts-a-molts amb entrenadors (pot ser principal o auxiliar)
    public function entrenadors()
    {
        return $this->belongsToMany(User::class, 'entrenador_equip', 'equip_id', 'usuari_id')
                    ->withPivot('rol_ent')
                    ->withTimestamps();
    }

// $equip = Equip::find(1);

// Entrenadors associats (amb rol_ent)
// foreach ($equip->entrenadors as $entrenador) {
//     echo $entrenador->name . ' - ' . $entrenador->pivot->rol_ent;
// }
public function entrenadorPrincipal()
{
    return $this->entrenadors()->wherePivot('rol_ent', 'principal');
}

// **** RELACIO Exercicis utilitzats per l'equip
public function exercicis()
{
    return $this->belongsToMany(Exercici::class, 'equip_exercici', 'equip_id', 'exercici_id');
}



}
