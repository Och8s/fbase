<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComunicatUsuari extends Model
{
    use HasFactory;

    protected $table = 'comunicat_usuari';

    public $timestamps = false;

    protected $fillable = [
        'comunicat_id',
        'usuari_id',
        'llegit',
        'llegit_at',
        'email_enviat',
        'email_enviat_at',
        'created_at',
    ];

    public function comunicat()
    {
        return $this->belongsTo(Comunicat::class);
    }

    public function usuari()
    {
        return $this->belongsTo(User::class);
    }
}
