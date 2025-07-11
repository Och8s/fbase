<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExitEsportiu extends Model
{
    use HasFactory;

    protected $table = 'exits';

    protected $fillable = [
        'titol',
        'foto',
        'descripcio',
        'data',
    ];
}

