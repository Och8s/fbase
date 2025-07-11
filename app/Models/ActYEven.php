<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActYEven extends Model
{
    use HasFactory;

    protected $table = 'act_y_even';

    protected $fillable = [
        'titol',
        'foto',
        'descripcio',
        'data_inici',
        'data_final',
        'horari',
        'dinar',
        'preu',
    ];

    public function subactivitats()
    {
        return $this->hasMany(SubActivitat::class);
    }
}
