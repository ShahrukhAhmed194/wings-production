<?php

namespace App\Jobs;

use App\Mail\ContactUs;
use App\Traits\EmailTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ContactUsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use EmailTrait;
    private $email='',$name='',$mobile_no='', $message='';
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, $email,$mobile_no, $message)
    {
        $this->email = $email;
        $this->name = $name;
        $this->mobile_no = $mobile_no;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //$this->dueEmail($this->email, $this->amount,$this->type,$this->message);
        Mail::to(env('ADMIN_NOTIFY_MAIL'))->send(new ContactUs('New contact mail', $this->name, $this->email, $this->mobile_no, $this->message));

    }
}
