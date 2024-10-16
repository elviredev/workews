<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
//use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobApplied extends Mailable
{
    use Queueable, SerializesModels;

    public $candidature;
    public $job;

    /**
     * Create a new message instance.
     */
    public function __construct($candidature, $job)
    {
      $this->candidature = $candidature;
      $this->job = $job;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouvelle candidature',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.job-applied',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];
        if ($this->candidature->resume_path) {
          $attachments[] = Attachment::fromPath(storage_path('app/public/' . $this->candidature->resume_path))
                ->as($this->candidature->resume_path)
                ->withMime('application/pdf');
        }
        return $attachments;
    }
}
