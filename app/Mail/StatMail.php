<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;


class StatMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $countComment, public $articles)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
    // Используйте config() для надежности
        $fromAddress = config('mail.from.address');
        $fromName = config('mail.from.name');
    
        // Если что-то пустое, используем значения по умолчанию
        if (empty($fromAddress)) {
            $fromAddress = 'm.shelukhin@internet.ru';
        }
        
        if (empty($fromName)) {
            $fromName = 'Laravel Blog';
        }
        
        
        return new Envelope(
            from: new Address($fromAddress, $fromName),
                    subject: 'Commentmail',
                );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.stat',
            with:[
                'countComment'=>$this->countComment,
                'countArticle' => $this->articles
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