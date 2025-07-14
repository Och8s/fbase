<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrenador extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'titulacio', 'equips_entrenats'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
