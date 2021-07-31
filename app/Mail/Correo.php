<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Correo extends Mailable
{
    use Queueable, SerializesModels;
    protected $usuarios;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($usuarios)
    {
        $this->usuarios = $usuarios;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $usuarios = $this->usuarios;
        return $this->view('Mails.correo', compact('usuarios'));
    }
}
