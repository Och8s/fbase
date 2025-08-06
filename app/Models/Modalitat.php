<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modalitat extends Model
{
    protected $fillable = [
        'nom',
        'espai_entren',
        'camp_partit',
        'coordinador_id',
    ];

    public function equips()
{
    return $this->hasMany(Equip::class);
}

    public function coordinador()
    {
        return $this->belongsTo(User::class, 'coordinador_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Categoria::class, 'categoria_modalitat')->withTimestamps();
    }
}

