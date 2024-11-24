<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProductDeleteAlert extends Mailable
{
    use Queueable, SerializesModels;
    
    public $product; // Producto eliminado

    /**
     * Create a new message instance.
     */
    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * Get the message envelope.
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Product Delete Alert',
        );
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // Asunto y vista de correo
        return $this->subject('Producto Eliminado')
                    ->view('emails.product_deleted_alert'); // Asegúrate de tener esta vista en resources/views/emails/product_deleted_alert.blade.php
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
