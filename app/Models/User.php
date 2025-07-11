<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Equip;
use App\Models\Jugador;


class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
        'dni',
        'telefon',
    ];


    /**git status---
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
     // Relación con Equipos (Entrenador)
     public function equips()
     {
         return $this->hasMany(Equip::class, 'entrenador_id');
     }

     // Relación con Jugadores (Tutor)
     public function jugadors()
     {
         return $this->belongsToMany(Jugador::class, 'tutor_jugador', 'usuari_id', 'jugador_id');
     }

        // Al model User
    public function modalitats()
    {
        return $this->hasMany(Modalitat::class, 'coordinador_id');
    }

    // Relació molts-a-molts amb equips (pot ser principal o auxiliar)
    public function equipsEntrenats()
    {
        return $this->belongsToMany(Equip::class, 'entrenador_equip', 'usuari_id', 'equip_id')
                    ->withPivot('rol_ent')
                    ->withTimestamps();
    }
    // para elegir uno u otro rol de entrenador...
// $user = auth()->user();

// // Tots els equips on és entrenador (principal o auxiliar)
// $user->equipsEntrenats;

// // Només equips on és auxiliar
// $user->equipsEntrenats()->wherePivot('rol_ent', 'auxiliar')->get();


// **** DONAR ACCES A EQUIPS PER ROLS
// Només equips on és entrenador principal
public function equipsComPrincipal()
{
    return $this->belongsToMany(Equip::class, 'entrenador_equip', 'usuari_id', 'equip_id')
                ->withPivot('rol_ent')
                ->wherePivot('rol_ent', 'principal')
                ->withTimestamps();
}

// Només equips on és entrenador auxiliar
const ROL_AUXILIAR = 'auxiliar';

public function equipsComAuxiliar()
{
    return $this->belongsToMany(Equip::class, 'entrenador_equip', 'usuari_id', 'equip_id')
                ->withPivot('rol_ent')
                ->wherePivot('rol_ent', self::ROL_AUXILIAR)
                ->withTimestamps();
}


// **** R3LACIÓ AMB DELS ENTRENADORS I COORDINADORS AMB ELS EXERCICIS
// Exercicis proposats com a entrenador
public function proExercicis()
{
    return $this->hasMany(ProExercici::class, 'entrenador_id');
}

// Exercicis validats com a coordinador
public function exercicisComCoordinador()
{
    return $this->hasMany(Exercici::class, 'coordinador_id');
}

// Exercicis creats com a entrenador
public function exercicisComEntrenador()
{
    return $this->hasMany(Exercici::class, 'entrenador_id');
}

// Reunions Users
public function reunions()
{
    return $this->belongsToMany(Reunio::class, 'reunio_usuari');
}

// enviament coumnicats
  public function comunicatsEnviats()
    {
        return $this->hasMany(Comunicat::class, 'usuari_id');
    }

    public function comunicatsRebuts()
    {
        return $this->belongsToMany(
            Comunicat::class,
            'comunicat_usuari',
            'usuari_id',
            'comunicat_id'
        )->withPivot('llegit', 'llegit_at', 'email_enviat', 'email_enviat_at', 'created_at');
    }
}
