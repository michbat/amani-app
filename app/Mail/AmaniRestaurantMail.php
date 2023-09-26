<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AmaniRestaurantMail extends Mailable
{
    use Queueable, SerializesModels;

    // 

    public $subject;
    public $body;
    public $view;

    /**
     * Create a new message instance.
     */

    //  Le constructeur de la classe reçoit trois paramètres qui correspondent au sujet du mail, son corps et la vue dans le dossier resources/views/mails)
    public function __construct($subject, $body, $view)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->view = $view;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: $this->view,
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
