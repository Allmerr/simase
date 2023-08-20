<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifikasiPesertaMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $mailData;
    protected $userEmail;
    protected $skemaName;

    /**
     * Create a new message instance.
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
        $this->userEmail = $mailData['user_email'];
        $this->skemaName = $mailData['skema_name'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Berhasil Mendaftar Skema ' . $this->skemaName,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'layouts.mail',
            with: [
                'skemaName' => $this->skemaName,
                'userEmail' => $this->userEmail,
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

    public function build(){
        // return $this->view('layouts.mail');
        return $this->to($this->userEmail)
        ->subject($this->skemaName)
        ->view('layouts.mail');
    }
}