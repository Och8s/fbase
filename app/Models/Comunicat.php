<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comunicat extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuari_id',
        'titol',
        'missatge',
        'tipus',
        'rol_desti',
        'equip_id',
        'enviat_per_email',
        'arxiu',
    ];

    public function creador()
    {
        return $this->belongsTo(User::class, 'usuari_id');
    }

    public function destinataris()
    {
        return $this->hasMany(ComunicatUsuari::class);
    }

    public function usuarisDestinataris()
    {
        return $this->belongsToMany(
            User::class,
            'comunicat_usuari',
            'comunicat_id',
            'usuari_id'
        )->withPivot('llegit', 'llegit_at', 'email_enviat', 'email_enviat_at', 'created_at');
    }

    public function equip()
    {
        return $this->belongsTo(Equip::class);
    }
}
