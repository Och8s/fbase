<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NenCampus extends Model
{
    use HasFactory;

    protected $table = 'nens_campus';

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
    ];

    protected $casts = [
        'consentiment_pares' => 'boolean',
        'drets_imatge' => 'boolean',
        'es_jugador_club' => 'boolean',
    ];
}
