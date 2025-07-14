<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentacioJugador extends Model
{
    protected $table = 'documentacio_jugadors';

    protected $primaryKey = 'id_documentacio';

    protected $fillable = [
        'id_jugador', 'dni', 'nie', 'passaport', 'tarjeta_sanitaria',
        'foto', 'portal_federat', 'mutua', 'consentiment', 'drets_imatges',
        'politica_privacitat', 'regim_intern', 'proteccio_dades',
        'protocol_violencia_sexual', 'certificat_medic', 'autoritzacio_paterna',
        'resguard_pagament', 'certificat_empadronament', 'certificat_escolaritzacio',
        'permiso_residencia_trabajo', 'fotocopia_custodia', 'permiso_viatge',
        'data_aportacio'
    ];

    public function jugador()
    {
        return $this->belongsTo(Jugador::class, 'id_jugador');
    }
}
