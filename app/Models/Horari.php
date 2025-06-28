<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horari extends Model
{
    use HasFactory;

    protected $fillable = [
        'equip_id',
        'lloc',
        'camp',
        'h_inici',
        'h_final',
        'durada',
        'tipus_act',
        'vestuari',
    ];

    public function equip()
    {
        return $this->belongsTo(Equip::class);
    }
}
