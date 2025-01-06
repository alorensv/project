<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TokenMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $token;
    public $duration;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $duration)
    {
        $this->token = $token;
        $this->duration = $duration;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.enviarToken')
                    ->subject('Tu token de acceso')
                    ->markdown('emails.token')
                    ->with([
                        'token' => $this->token,
                        'duration' => $this->duration
                    ]);

    }
}
