<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EvidenceSuggestion extends Mailable
{
    public $subject = "Prueba ICA - Resultado de Evidencias";
    public $aprobadas;
    public $incorrectas;
    public $usuario;
    public $prueba;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($verify, $unverify, $username, $testName)
    {
        $this->aprobadas = $verify;
        $this->incorrectas = $unverify;
        $this->usuario = $username;
        $this->prueba = $testName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.evidence-suggestion');
    }
}
