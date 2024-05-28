<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionPagos extends Mailable
{
    use Queueable, SerializesModels;

    protected $nombre_cliente;
    protected $moneda;
    protected $monto;


    /**
     * Create a new message instance.
     */
    public function __construct($nombre_cliente, $moneda, $monto)
    {
        $this->nombre_cliente = $nombre_cliente;
        $this->moneda = $moneda;
        $this->monto = $monto;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notificacion Pagoo',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.notificacion_pagos',
            with: [
                'nombre_cliente' => $this->nombre_cliente,
                'moneda' => $this->moneda,
                'monto' => $this->monto,
            ]
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
