<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifikasiExpiredMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $mailData;
    protected $subject_;
    protected $message_;
    protected $email;
    protected $skema;

    /**
     * Create a new message instance.
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
        $this->subject_ = $mailData['subject_'];
        $this->message_ = $mailData['message_'];
        $this->email = $mailData['email'];
        $this->skema = $mailData['skema'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notifikasi Atas Masa Berlaku Sertifikat Anda pada Skema '.$this->skema,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'layouts.mail_sertifikat',
            with: [
                'message_' => $this->message_,
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

    public function build()
    {
        // return $this->view('layouts.mail');
        return $this->to($this->email)
            ->subject($this->subject_)
            ->view('layouts.mail_sertifikat');
    }
}