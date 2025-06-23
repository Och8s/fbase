<?php
// Mailable
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InformeJugadorMail extends Mailable
{
    use Queueable, SerializesModels;

    public $jugador;
    public $estadistiques;

    public function __construct($jugador, $estadistiques)
    {
        $this->jugador = $jugador;
        $this->estadistiques = $estadistiques;
    }

    public function build()
    {
        return $this->subject('Informe del jugador '.$this->jugador->nom)
                    ->markdown('emails.informe');
    }
}
