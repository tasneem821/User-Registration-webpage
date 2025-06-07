<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content; 
use Illuminate\Queue\SerializesModels;
use App\Models\RegisteredUsers;

class NewUserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $user; 
    /**
     * Create a new message instance.
     */
    public function __construct(RegisteredUsers $user)
    {
        $this->user = $user; 
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New registered user', 
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content 
    {
        return new Content(
            view: 'emails.new_user', 
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