<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $name;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $name, $email)
    {
        $this->subject = $subject;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('emails.welcome');
    }
}
