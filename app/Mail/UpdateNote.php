<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdateNote extends Mailable
{
    use Queueable, SerializesModels;

    public $content;
    public $subject;
    public $name = null;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $content, $name = null)
    {
        $this->content = $content;
        $this->name = $name;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('emails.default');
    }
}
