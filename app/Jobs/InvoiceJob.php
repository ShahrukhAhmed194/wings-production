<?php

namespace App\Jobs;

use App\Traits\EmailTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InvoiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use EmailTrait;
    private $email='',$amount='',$type='', $orderId='',$message='';
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$amount, $type, $orderId, $message)
    {
        $this->email = $email;
        $this->amount = $amount;
        $this->type = $type;
        $this->orderId = $orderId;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->paymentEmail($this->email,$this->amount,$this->orderId,$this->type,$this->message);

    }
}
