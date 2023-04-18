<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Tarefa;

class TarefaAtualizadaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $id;
    public $tarefa;
    public $data_limite_conclusao;
    public $url;

    public function __construct(Tarefa $tarefa)
    {
        $this->id = $tarefa->id;
        $this->tarefa = $tarefa->tarefa;
        $this->data_limite_conclusao = date('d/m/Y', strtotime($tarefa->data_limite_conclusao));
        $this->url = "http://89.38.150.159/tarefa/$tarefa->id";
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tarefa atualizada',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.tarefa-atualizada',
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
