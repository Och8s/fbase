<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreCampus extends Model
{
    use HasFactory;

    protected $table = 'pre_campus';

    protected $fillable = [
        'nom',
        'cognoms',
        'dni',
        'seg_social',
        'data_naixement',
        'domicili',
        'cp',
        'telefon',
        'nom_pares',
        'num_compte',
        'consentiment_pares',
        'drets_imatge',
        'es_jugador_club',
        'intolerancia',
        'incapacitat',
        'estat',
        'jugador_id',
    ];

    protected $casts = [
        'consentiment_pares' => 'boolean',
        'drets_imatge' => 'boolean',
        'es_jugador_club' => 'boolean',
    ];

    public function jugador()
    {
        return $this->belongsTo(Jugador::class, 'jugador_id');
    }
}

