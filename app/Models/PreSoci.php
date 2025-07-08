<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreSoci extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'dni',
        'data_naix',
        'telefon',
        'poblacio',
        'adreca',
        'numero_compte',
        'estat',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

