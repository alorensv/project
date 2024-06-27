<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReceived extends Mailable
{
    use Queueable, SerializesModels;
    public $contact;
    public $messageContent;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact, $messageContent)
    {
        $this->contact = $contact;
        $this->messageContent = $messageContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contact_received')
            ->subject('¡Haz recibido un nuevo contacto!')
            ->with([
                'contact' => $this->contact,
                'messageContent' => $this->messageContent,
            ]);
    }
}
