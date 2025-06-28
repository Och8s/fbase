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

}
