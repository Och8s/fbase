<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = [
        'nom',
        'cognoms',
        'email',
        'assumpte',
        'text',
        'data',
        'estat',
    ];
}
