<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ExitEsportiu extends Model
{
    use HasFactory;

    protected $table = 'exits';

protected $fillable = ['titol','foto','descripcio','data','actiu'];
protected $casts = [
    'data' => 'date',
];
    // Si 'data' és YEAR a la BBDD, millor deixar-la com string/int (no Carbon).
    // Si fos DATE, podries fer: protected $casts = ['data' => 'date'];

    /** Scope per només actius */
    public function scopeActius($q)
    {
        return $q->where('actiu', true);
    }
}
