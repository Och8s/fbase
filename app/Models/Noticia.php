<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

        // 👇 Aquesta línia és clau
    protected $table = 'noticies';

   protected $fillable = [
    'titol',
    'descripcio',
    'foto',
    'data',
    'seccio',
    'article', // 👈 afegit nou
];


}
