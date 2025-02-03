<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoicePaid extends Mailable
{
    use Queueable, SerializesModels;

    public $payment_details;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($payment_details, $subject)
    {
        $this->payment_details = $payment_details;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->subject($this->subject)->view('emails.payment-invoice');
        return $this->subject($this->subject)->bcc(env('ADMIN_NOTIFY_MAIL'))->markdown('emails.payment-invoice',['payment_details'=>$this->payment_details]);

    }
}
