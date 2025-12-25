<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use App\Models\Comment;
use App\Models\Article;
use Illuminate\support\Facades\Log;
use Illuminate\Queue\SerializesModels;

class Commentmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public Comment $comment, public Article $article, public $author)
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
            markdown: 'mail.comment',
            with:[
                'comment'=>$this->comment,
                'article_title'=>$this->article->title,
                'author'=>$this->author,
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