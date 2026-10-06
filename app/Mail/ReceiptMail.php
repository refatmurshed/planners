<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $pdfPath;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $pdfPath)
    {
        $this->name = $name;
        $this->pdfPath = $pdfPath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Subscription Payment Receipt',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.receipt',
        );
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this
            ->subject('Subscription Payment Receipt')
            ->view('emails.receipt')
            ->attach($this->pdfPath, [
                'as' => 'Money_Receipt.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}