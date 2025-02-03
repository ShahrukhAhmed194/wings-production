<?php

namespace App\Http\Controllers;
use App\Models\PaymentHistory;
use App\Traits\EmailTrait;
use Illuminate\Http\Request;
use Karim007\LaravelNagad\Facade\NagadPayment;
use Karim007\LaravelNagad\Facade\NagadRefund;

class NagadController extends Controller{

    use EmailTrait;

    public function pay()
    {
        //return "hello";
        //NagadPayment::executePayment(20, uniqid());
        $member_type = auth()->user()->memberType;
        $amount = 1000;
        $trx_id = uniqid();
        if (isset($member_type) && $member_type->amount) $amount = $member_type->amount;
        try {
            PaymentHistory::create([
                'user_id'=>auth()->id(),
                'status'=>'pending',
                'amount'=>$amount,
                'trx_id'=>$trx_id,
                'type'=>'Registration Fee',
            ]);
            config(['nagad.callback_url' => env('NAGAD_CALLBACK_URL')]);
            $abc = NagadPayment::create($amount, $trx_id);
            //dd($abc);
            if (isset($abc) && $abc->status == "Success"){
                return redirect()->away($abc->callBackUrl);
            }
        }catch (\Exception $e){
            //
        }
        return redirect()->back()->with("error-alert2", "Invalid request try again after few time later");
    }


    //To receive the callback response use this method:

    /**
     * This is the routed callback method
     * which receives a GET request.
     *
     * */

    public function callback(Request $request)
    {
        if (!$request->status && !$request->order_id) {
            return response()->json([
                "error" => "Not found any status"
            ], 500);
        }

       /* if (config("nagad.response_type") == "json") {
            return response()->json($request->all());
        }*/

        $verify = NagadPayment::verify($request->payment_ref_id);

        if (isset($verify->status) && $verify->status == "Success") {
            $user =auth()->user();
            try {
                PaymentHistory::where('trx_id',$verify->orderId)->update(['status'=>'success','nagad_tnx_id'=>$verify->issuerPaymentRefNo]);
                $user->update(['payment_status'=>'paid','payment_trx_number'=>$verify->issuerPaymentRefNo]);
            }catch (\Exception $e){
                //
            }
            try {
                dispatch(new \App\Jobs\InvoiceJob($user->email, $verify->amount,'Registration Fee invoice for '.$user->last_name,$verify->issuerPaymentRefNo,'Dear '.$user->last_name.' Thank you for your payment.'))->delay(now()->addSeconds(10));
                //$this->paymentEmail($verify->amount,$verify->orderId,'Registration Fee');
            }catch (\Exception $e){
                //
            }
            return $this->success($verify->issuerPaymentRefNo);
            //return redirect("/nagad-payment/{$verify->orderId}/success");
        } else {
            try {
                PaymentHistory::where('trx_id', $verify->orderId)->update(['status'=>'Failed']);
            }catch (\Exception $e){
                //
            }
            return $this->fail($verify->orderId);
            //return redirect("/nagad-payment/{$verify->orderId}/fail");
        }

        /*$data = $this->validate($request,[
            "merchant" => "required",
              "order_id" => "required",
              "payment_ref_id"=>'required'
        ]);*/

        /*+"merchantId": "683002007104225"
        +"orderId": "638ddf352bbcf"
        +"paymentRefId": "MTIwNTE4MDgyMzI1My42ODMwMDIwMDcxMDQyMjUuNjM4ZGRmMzUyYmJjZi43ZmE4MDg5NmE3YmJhMDZjMzE5Nw=="
        +"amount": "20"
        +"clientMobileNo": "015****2467"
        +"merchantMobileNo": "01300200710"
        +"orderDateTime": "2022-12-05 18:08:21.0"
        +"issuerPaymentDateTime": "2022-12-05 18:09:24.0"
        +"issuerPaymentRefNo": "00010DHW"
        +"additionalMerchantInfo": null
        +"status": "Success"
        +"statusCode": "000"
        +"cancelIssuerDateTime": null
        +"cancelIssuerRefNo": null
        +"serviceType": "REGULAR_ECOM"*/
        //NagadRefund::refund($paymentRefId,$refundAmount);

    }

    public function refund($paymentRefId)
    {
        $refundAmount=10;
        $verify = NagadRefund::refund($paymentRefId,$refundAmount);
        if (isset($verify->status) && $verify->status == "Success") {
            return $this->success($verify->orderId);
            //return redirect("/nagad-payment/{$verify->orderId}/success");
        } else {
            try {
                PaymentHistory::where('trx_id', $verify->orderId)->update(['status'=>'Failed']);
            }catch (\Exception $e){
                //
            }
            return $this->fail($verify->orderId);
        }
    }
    public function success($transId)
    {
        return view("nagad::success", compact('transId'));
    }

    public function fail($transId)
    {
        return view("nagad::failed", compact('transId'));
    }
}
