<?php

namespace App\Jobs;

use App\Mail\InvoiceDue;
use App\Traits\EmailTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class InvoiceDueJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use EmailTrait;
    private $email='',$amount='',$type='', $message='';
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$amount, $type, $message)
    {
        $this->email = $email;
        $this->amount = $amount;
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fees[] = [
            'name' => $this->type,
            'amount' => $this->amount
        ];

        // Send Mail to admin
        $payment_details = [
            'amount' => $this->amount,
            'custom_text' => $this->message,
            'fees' => $fees
        ];
        try {
            Mail::to($this->email)->send(new InvoiceDue($payment_details, $this->type));
        }catch (\Exception $e){
            //
        }
        //$this->dueEmail($this->email, $this->amount,$this->type,$this->message);
    }
}
