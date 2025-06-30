<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\URL;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $verificationUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        // Buat URL verifikasi bertanda tangan (signed URL)
        $this->verificationUrl = URL::temporarySignedRoute(
            'verification.verify', // Ini harus sama dengan nama rute kamu
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        // return new Envelope(
        //     subject: 'Verify User Mail',
        // );

        return $this->subject('Verifikasi Akun Anda')
            ->view('emails.verify-user')
            ->with([
                'verificationUrl' => $this->verificationUrl,
            ]);
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.verify-user',
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
