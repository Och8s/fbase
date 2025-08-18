<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoHistorica extends Model
{
    use HasFactory;

    // Si el nom de la taula no segueix el plural "normal"
    protected $table = 'fotos_historiques';

    // Camps mass assignable
    protected $fillable = [
        'titol',
        'foto',          // guarda aquí la ruta relativa (p. ex. "historia/fotos/nom.jpg")
        'facilitador',
        'descripcio',
        'data',          // pot ser date o datetime a la BBDD
        'lloc',
    ];

    // Casts
    protected $casts = [
        'data' => 'date',  // així pots fer $model->data->format('d/m/Y')
    ];

    // Afegim un atribut calculat a la sortida JSON si vols
    protected $appends = ['foto_url'];

    /**
     * Accessor per obtenir la URL pública de la imatge.
     */
    public function getFotoUrlAttribute(): ?string
    {
        if (!$this->foto) return null;

        // Si guardes a "storage/app/public/..." i tens enllaç simbòlic "storage"
        // ex: $this->foto = "historia/fotos/nom.jpg"
        return asset('storage/'.$this->foto);
    }

    /**
     * Scope per ordenar per data (asc o desc).
     */
    public function scopeOrderByData($query, string $direction = 'asc')
    {
        return $query->orderBy('data', $direction);
    }
}
