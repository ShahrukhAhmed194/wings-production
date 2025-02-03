<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MemberRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    // public $member_name;
    public $subject;
    public $name;
    public $email;
    public $mobile_number;
    public $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $name, $email, $mobile_number, $comment)
    {
        $this->subject = $subject;
        $this->name = $name;
        $this->email = $email;
        $this->mobile_number = $mobile_number;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email, $this->name)->view('emails.memberRequest');
    }
}
