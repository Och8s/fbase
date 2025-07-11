<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubActivitat extends Model
{
    use HasFactory;

    protected $fillable = [
        'act_y_even_id',
        'titol',
        'horari',
        'descripcio',
    ];

    public function activitat()
    {
        return $this->belongsTo(ActYEven::class, 'act_y_even_id');
    }
}
