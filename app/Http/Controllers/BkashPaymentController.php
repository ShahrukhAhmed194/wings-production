<?php

namespace App\Http\Controllers;

use App\Models\FestivalMember;
use App\Models\PaymentHistory;
use App\Traits\EmailTrait;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;
use Karim007\LaravelNagad\Facade\NagadPayment;

class BkashPaymentController extends Controller
{
    use GeneralTrait, EmailTrait;
    public function __construct()
    {
        /*$this->middleware(FestivalMiddleware::class);
        parent::__construct();*/
    }
    public function createPayment(Request $request)
    {
        $member_type = auth()->user()->memberType;
        $amount = 1000;
        $trx_id = uniqid();
        if (isset($member_type) && $member_type->amount) $amount = $member_type->amount;
        DB::beginTransaction();
        try {
            PaymentHistory::create([
                'user_id'=>auth()->id(),
                'status'=>'pending',
                'amount'=>$amount,
                'trx_id'=>$trx_id,
                'type'=>'Registration Fee',
            ]);
            $request['intent'] = 'sale';
            $request['mode'] = '0011';
            $request['payerReference'] = $trx_id;
            $request['currency'] = 'BDT';
            $request['amount'] = $amount;
            $request['merchantInvoiceNumber'] = $trx_id;
            $request['callbackURL'] = env('APP_URL').'/user/bkash/callback';

            $request_data_json = json_encode($request->all());

            $response =  BkashPaymentTokenize::cPayment($request_data_json);
            if (isset($response['bkashURL'])) {
                DB::commit();
                return redirect()->away($response['bkashURL']);
            }
            else return redirect()->back()->with('error-alert2', $response['statusMessage']);
        }catch (\Exception $e){
            DB::rollback();
        }
        return redirect()->back()->with("error-alert2", "Invalid request try again after few time later");

    }

    public function callBack(Request $request)
    {
        //paymentID=TR00117B1674409647770&status=success&apiVersion=1.2.0-beta
        if ($request->status == 'success'){
            $response = BkashPaymentTokenize::executePayment($request->paymentID);
            if (!$response){
                $response = BkashPaymentTokenize::queryPayment($request->paymentID);
            }
            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
                $tnx = $response['payerReference'];
                $user = auth()->user();
                try {
                    PaymentHistory::where('trx_id',$tnx)->update(['status'=>'success','nagad_tnx_id'=>$response['trxID']]);
                    $user->update(['payment_status'=>'paid','payment_trx_number'=>$response['trxID']]);
                }catch (\Exception $e){
                    //
                }
                try {
                    dispatch(new \App\Jobs\InvoiceJob($user->email, $response['amount'],'Registration Fee invoice for '.$user->last_name,$response['trxID'],'Dear '.$user->last_name.' Thank you for your payment.'))->delay(now()->addSeconds(5));
                }catch (\Exception $e){
                    //
                }
                return BkashPaymentTokenize::success('Dear '.$user->last_name.' Thank you for your payment.', isset($response['trxID'])?$response['trxID']:'');
            }
            return BkashPaymentTokenize::failure($response['statusMessage']);
        }else if ($request->status == 'cancel'){
            return BkashPaymentTokenize::cancel('Your payment is canceled');
        }else{
            return BkashPaymentTokenize::failure('Your transaction is failed');
        }
    }

}
