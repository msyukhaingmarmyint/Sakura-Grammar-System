<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CertificateMail extends Mailable
{
    use Queueable, SerializesModels;
public $user;
public $topic;
    protected $pdfContent;
    /**
     * Create a new message instance.
     *
     * @return void
     */
   public function __construct($user, $pdfContent, $topic)
    {
        $this->user = $user;
        $this->topic = $topic;
        $this->pdfContent = $pdfContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->subject("Congratulations on your Sakura Grammar Certificate!")
                    ->view('user.certificate_notification') 
                    ->attachData($this->pdfContent, 'Certificate.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
