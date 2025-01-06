<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificarFirma extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $firmaDocumento;

    public function __construct($firmaDocumento)
    {
        $this->firmaDocumento = $firmaDocumento;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notificarFirma')
            ->subject('Notificación: haz recibido una invitación para firmar un documento electrónicamente')
            ->with([
                'firmaDocumento' => $this->firmaDocumento,
            ]);
    }

}
