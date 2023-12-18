<?php

namespace App\Mail;

use App\Models\Admin\Configs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class promotionalMail extends Mailable implements ShouldQueue
// class promotionalMail extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    // public $partner;
    /**
     * Create a new message instance.
     */
    public function __construct(
        public readonly array $data
    ) {
        $this->email = $data['email'];
        // $this->partner = ;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $config = Configs::find(1);
        return new Envelope(
            from: new Address($config->email, $config->title),
            to: [
                new Address($this->data['partner']->email, $this->data['partner']->name),
            ],
            subject: $this->data['email']->title,
            tags: ['assgapa'],
            metadata: [
                'email_id' => $this->data['email']->id,
            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'livewire.admin.marketing.promotion',
            with: [
                'config' => Configs::find(1),
            ],
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
