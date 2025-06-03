<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageContent;
    public $imagePath;

    /**
     * Create a new message instance.
     */
    public function __construct($messageContent, $imagePath = null)
    {
        $this->messageContent = $messageContent;
        $this->imagePath = $imagePath;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $email = $this->subject('Newsletter du CSC')
                      ->view('emails.newsletter')
                      ->with(['messageContent' => $this->messageContent]);

        if ($this->imagePath) {
            $email->attach(storage_path('app/public/' . $this->imagePath));
        }

        return $email;
    }
}
