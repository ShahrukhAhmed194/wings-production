<?php
namespace App\Traits;

use App\Mail\InvoiceDue;
use App\Mail\InvoicePaid;
use Illuminate\Support\Facades\Mail;

trait EmailTrait{

    protected function paymentEmail($email,$amount, $trx_id, $type, $custom_text=''){
        $fees[] = [
            'name' => $type,
            'amount' => $amount
        ];

        // Send Mail to admin
        $payment_details = [
            'amount' => $amount,
            'date' => date('M d Y'),
            'id' => $trx_id,
            'custom_text' => $custom_text ?? 'Thanks for you membership request, we will get back to you soon',
            'fees' => $fees
        ];
        try {
            Mail::to($email)->send(new InvoicePaid($payment_details, $type));
        }catch (\Exception $e){
            //
        }
    }
    protected function dueEmail($email, $amount, $type, $custom_text=''){
        $fees[] = [
            'name' => $type,
            'amount' => $amount
        ];

        // Send Mail to admin
        $payment_details = [
            'amount' => $amount,
            'custom_text' => $custom_text,
            'fees' => $fees
        ];
        try {
            Mail::to($email)->send(new InvoiceDue($payment_details, $type));
        }catch (\Exception $e){
            //
        }

    }

}
