<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendStudentMail extends Mailable
{
    use Queueable, SerializesModels;
    public $studentData, $PDF;
    /**
     * Create a new message instance.
     */
    public function __construct($student, $pdf)
    {
        $this->studentData = $student;
        $this->PDF         = $pdf;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Student Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.studentMail',
            with: [
                'student' => $this->studentData
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

        return [
            Attachment::fromData(fn () =>  $this->PDF->output(), $this->studentData->student_code.'_Result.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
