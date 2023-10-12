<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifikasiKelulusanPeserta extends Mailable
{
    use Queueable, SerializesModels;

    protected $mailData;

    protected $userEmail;

    protected $statusKelulusan;

    protected $skemaName;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        $this->mailData = $mailData;
        $this->userEmail = $mailData['user_email'];
        $this->skemaName = $mailData['skema_name'];
        $this->statusKelulusan = $mailData['status_kelulusan'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notifikasi Kelulusan Peserta pada Skema '.$this->skemaName.'',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'layouts.mail_kelulusan_peserta',
            with: [
                'skemaName' => $this->skemaName,
                'userEmail' => $this->userEmail,
                'statusKelulusan' => $this->statusKelulusan,
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
        return $this->to($this->userEmail)
            ->subject($this->skemaName)
            ->view('layouts.mail');
    }
}
