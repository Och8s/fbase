<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'nom',
        'durada_oficial',
        'tipus_canvis',
    ];

    public function modalitats()
    {
        return $this->belongsToMany(Modalitat::class, 'categoria_modalitat')->withTimestamps();
    }
}

