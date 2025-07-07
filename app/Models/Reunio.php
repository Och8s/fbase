<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reunio extends Model
{
    protected $fillable = [
    'titol', 'creador_id', 'equip_id', 'data', 'hora', 'lloc', 'continguts', 'acords'
];

    // Relació: una reunió pertany a un equip
    public function equip()
    {
        return $this->belongsTo(Equip::class);
    }

    // Relació: una reunió pot tenir molts usuaris
    public function usuaris()
    {
        return $this->belongsToMany(User::class, 'reunio_usuari');
    }

    public function creador()
{
    return $this->belongsTo(User::class, 'creador_id');
}

}
