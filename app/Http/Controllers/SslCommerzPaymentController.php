<?php

namespace App\Http\Controllers;
use App\Models\PaymentHistory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\DB;

class SslCommerzPaymentController extends Controller
{

    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "admission_payments"
        # In admission_payments table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
        /*Validator::make($request->all(),[
            'user_id'=>'required|not_in:0|exists:users,id',
        ])->validate();*/
        $user = auth()->user();

        $type = $user->memberType;
        if (!isset($type->id)) return redirect('/')->with('error-alert', 'Invalid Membership type contact with admin');
        if ($type->amount ==null || $type->amount <1) return redirect('/')->with('error-alert', 'Invalid request');
        $amount=$type->amount;

        $post_data = array();
        $post_data['total_amount'] = $amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('payment_histories')
            ->where('trx_id', $post_data['tran_id'])
            ->updateOrInsert([
                'user_id'=>auth()->id(),
                'trx_id' => $post_data['tran_id'],
                'amount'=>$amount,
                'status'=>'Pending',
                'type'=>'Registration Fee',
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');
        $payment_options=json_decode($payment_options);
        return redirect()->away($payment_options->data);
        /*if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }*/

    }

    public function success(Request $request)
    {
        //echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('payment_histories')
            ->where('trx_id', $tran_id)
            ->select('trx_id', 'status','amount')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                DB::table('payment_histories')
                    ->where('trx_id', $tran_id)
                    ->update(['status' => 'Processing']);
                $this->paymentUpdate($tran_id);
                //echo "<br >Transaction is successfully Completed";
                return redirect('/')->with('success-alert', 'Your payment is success.');
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('payment_histories')
                    ->where('trx_id', $tran_id)
                    ->update(['status' => 'Failed']);
                //echo "validation Fail";
                return redirect('/')->with('error-alert', 'Your payment is fail.');
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            //echo "Transaction is successfully Completed";
            $this->paymentUpdate($tran_id);
            return redirect('/')->with('success-alert', 'Your payment is success.');
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            //echo "Invalid Transaction";
            return redirect('/')->with('error-alert', 'Invalid Transaction.');
        }

    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('payment_histories')
            ->where('trx_id', $tran_id)
            ->select('trx_id', 'status', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('payment_histories')
                ->where('trx_id', $tran_id)
                ->update(['status' => 'Failed']);
            //echo "Transaction is Failed";
            return redirect('/')->with('error-alert', 'Transaction is Failed.');
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            //echo "Transaction is already Successful";
            $this->paymentUpdate($tran_id);
            return redirect('/')->with('success-alert', 'Your payment is success.');
        } else {
            //echo "Transaction is Invalid";
            return redirect('/')->with('error-alert', 'Transaction is Invalid');
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('payment_histories')
            ->where('trx_id', $tran_id)
            ->select('trx_id', 'status', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('payment_histories')
                ->where('trx_id', $tran_id)
                ->update(['status' => 'Canceled']);
            //echo "Transaction is Cancel";
            return redirect('/')->with('error-alert', 'Transaction is Cancel');
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            //echo "Transaction is already Successful";
            $this->paymentUpdate($tran_id);
            return redirect('/')->with('success-alert', 'Your payment is success.');
        } else {
            //echo "Transaction is Invalid";
            return redirect('/')->with('error-alert', 'Transaction is Invalid');
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('payment_histories')
                ->where('trx_id', $tran_id)
                ->select('trx_id', 'status','amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->pay_amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('payment_histories')
                        ->where('trx_id', $tran_id)
                        ->update(['status' => 'Processing']);
                    $this->paymentUpdate($tran_id);
                    //echo "Transaction is successfully Completed";
                    return redirect('/')->with('success-alert', 'Your payment is success.');
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('payment_histories')
                        ->where('trx_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    //echo "validation Fail";
                    return redirect('/')->with('error-alert', 'Validation Fail');
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.
                $this->paymentUpdate($tran_id);
                //echo "Transaction is already successfully Completed";
                return redirect('/')->with('success-alert', 'Your payment is success.');
            } else {
                #That means something wrong happened. You can redirect customer to your product page.
                //echo "Invalid Transaction";
                return redirect('/')->with('error-alert', 'Invalid Transaction');
            }
        } else {
            //echo "Invalid Data";
            return redirect('/')->with('error-alert', 'Invalid Data');
        }
    }

    /*
     * method for admission table update with payment
     * */
    public function paymentUpdate($tran_id)
    {
        $pay = PaymentHistory::where('trx_id', $tran_id)->first();
        if(isset($pay->id)) $user = User::find($pay->user_id);
        if(isset($user->id)){$user->update(['payment_status' => 'paid','payment_method'=>'SSLCommerze','payment_trx_number'=>$tran_id]);}
    }

}
