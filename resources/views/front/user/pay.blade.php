@extends('front.layouts.master')

@section('head')
    @include('meta::manager', [
        'title' => 'Membership Payment - ' . ($settings_g['title'] ?? env('APP_NAME')),
    ])
@endsection

@section('master')
<div class="page_wrap">
    <div class="container">
        <div class="up_wrap">
            <div class="card shadow mb-4">
                <div class="card-header primary_header">
                    <h4 class="d-inline-block mb-0">Membership Payment</h4>
                </div>

                <div class="card-body text-center">
                    <p>Please pay {{ isset(auth()->user()->memberType) ? auth()->user()->memberType->amount : 1000 }} tk to active your membership.</p>
                    <a class="btn btn-success" href="{{route('nagad.pay')}}">Pay Via Nagad</a>
                    <a class="btn btn-primary" style="background-color: #ff00af" href="{{route('member.bkash.pay')}}">Pay Via Bkash</a>
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Term and condition
                </button>

                <!-- Modal -->
                <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center" id="exampleModalLabel">Terms & Conditions</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    The following Terms and Conditions shall form the basis of initial agreement to be signed between the Merchant and the Software Shop Limited (hereafter referred as SSL) for availing Payment Gateway Source (branded under SSLCOMMERZ). Notwithstanding anything contained herein, all terms and conditions stipulated by SSL pertaining to any services/ facilities offered by SSL COMMERZ, shall continue to be applicable to the Merchant, provided, however, in the event of a conflict in such other terms and conditions stipulated by SSL and the terms herein, these terms shall have an overriding effect. These terms will be in addition to and not in derogation of the terms and conditions relating to services/facilities offered by SSI which are availed by the Merchant.
                                </p>
                                <p>
                                    Term & Conditions
                                </p>
                                <p>
                                1. MERCHANTS GENERAL OBLIGATIONS
                                </p>
                                <p>
                                1.1. Merchant shall receive an API (Test & live) from SSL under this MEF for testing the service modality of SSLCOMMERZ Payment Gateway Service;
                                </p>
                                <p>
                                    1.2. After testing technical feasibility and proper handshake from the merchant portal to SSLCOMMERZ payment gateway, the service shall go live through integration of the Live API. Merchant shall provide its Logo to SSL so that SSL can display the logo of Merchant in the SSLCOMMERZ Website and on the payment page;
                                </p>
                                <p>
                                    1.3. Merchant will provide customer's information of all/any successful transaction in a documented format to SSL for any circumstances; this format will be communicated by SSL to the Merchant over email.

                                </p>
                                <p>1.4. Merchant is not authorized to resell or sub-contract this service to any third parties;
                                </p>
                                <p>1.5. Merchant authorizes SSL to receive all the payments and act as the Online Payment Gateway Facilitator on behalf of the merchant;
                                </p>
                                <p>1.6. Merchant shall not sell any products which is declared illegal or banned by the law of Bangladesh Govt.
                                </p>
                                <p>1.7. Merchant is expected to sign a formal agreement in legal papers with SSL within one month of going live with the services. In the absence of the formal agreement, the Merchant gives consent to SSL that this MEF will be acceptable in the court of law for any litigation or legal issues.

                                </p>
                                <p>2. SSL's GENERAL OBLIGATIONS
                                </p>
                                <p>2.1. SSL shall be responsible to receive and process all online payments based on Merchant's request;
                                </p>
                                <p>2.2. SSL shall have the full authority to reject any transaction request if it seems suspicious or fraudulent in nature;
                                </p>
                                <p>2.3. SSL will enable all major payment channels to the customer based on the acceptance and certification by respective banks;
                                </p>
                                <p>2.4. SSL reserves the rights to revise and update all Merchant Service Fees and TDRs as stated above as per required. These changes shall be notified to the Merchant in writing.
                                </p>
                                <p>2.5. Subject to the terms and conditions of the MEF, Settlement Net Amount for transactions will be released on proof of delivery

                                </p>
                                <p>3. CHARGEBACK
                                </p>
                                <p>3.1. If a Transaction is an Invalid or Fraud Transaction, Bank may, with prior discussion with SSL (and without a request or demand from a Cardholder), Refuse to accept the Transaction; or
                                </p>
                                <p>3.2. If the Transaction has been processed, at any time within 180 days of the Transaction, charge that Transaction back to the Customer by debiting the Merchant Account or otherwise exercising its rights under the MEF.
                                </p>
                                <p>3.3. Merchant is liable to verify the shipping address before delivering any product to customer's shipping address.
                                </p>
                                <p>3.4. Merchant shall not deliver a product in an address other than the address mentioned as delivery address by the Customer. If card holder claims for charge back, merchant must submit proper delivery receipts & invoices, otherwise Merchant will bear the liability of charge back.

                                </p>
                                <p>3.5. Here, Invalid or Fraud Transaction shall mean-

                                </p>
                                <p>i. The transaction and its records are illegal;
                                </p>
                                <p>ii. The particulars inserted in the order form are not identical with the actual particulars identifying the Cardholder;
                                </p>
                                <p>iii. The Nominated Card is invalid at the time of transaction;
                                </p>
                                <p>iv. The Nominated Card is listed on the Warning Bulletin issued to SSL;
                                </p>
                                <p>v. The Merchant has failed to observe the MEF in relation to the transaction;
                                </p>
                                <p>vi. The Nominated Card was used without the consent of the Cardholder.

                                </p>
                                <p>4. REFUNDS/ REFUND POLICY TO CUSTOMERS
                                </p>
                                <p>4.1. In the event of a Customer effecting a transaction by using a Payment Card, the Merchant may request SSL for a refund on any grounds whatsoever within a period of seven (07) days from the actual delivery of the product, then SSL shall be entitled to cancel authorization and refuse to make any payments to the Merchant and/or enforce a refund from the Merchant. SSL shall forthwith inform the Merchant of the same and shall debit or collect the payment from the Merchant's Account and make an intermediate credit to SSL's Account in favor of the said Customer.
                                </p>
                                <p>4.2. In the event the Merchant accepts a customer order/agrees to provide the service to the Customer but however subsequently notifies to SSI about the Merchant's inability to comply with a customer order/service. Merchant shall forthwith make a proper cancellation for giving effect to the same as well as provide the funds in their account to facilitate a refund of the entire amount due to the customer. Any deductions made by SSL from the Merchant shall not be challenged by the Merchant for any reason whatsoever.
                                </p>
                                <p>4.3. In the event of a refund to a cardholder In respect of any transaction of any goods,/ services that are not received as ordered by the Cardholder or are lawfully rejected or services are not performed or partly performed or cancelled or price is lawfully disputed by the Cardholder or price adjustment is not allowed or for any other reason whatsoever, a credit slip shall be issued by the Merchant to SSL within seven (07) to nine (09) working days after the refund has been agreed between the Merchant and the cardholder and SSL shall:

                                </p>
                                <p>i. Debit the Merchant's account forthwith; and/or
                                </p>
                                <p>i. Deduct the outstanding amount from the Merchant's account; and/or
                                </p>
                                <p>ii. If there is insufficient funds available in Merchant's account, SSL shall claim from the Merchant the amount to be refunded to the Customer

                                </p>
                                <p>5. GENERAL TERMS AND CONDITIONS
                                </p>
                                <p>i. Effective Date: This MEF shall lake effect upon the date of signing the Formand shall be valid till the period mentioned insub-clause iv
                                </p>
                                <p>ii. Modification: This MEF may be renegotiated, modified or amended at any time by mutual agreements by SSL and Merchant if required.
                                </p>
                                <p>iii. Renewal: This MEF will be automatically renewed for yearly basis unless otherwise notified by the parties to each other.
                                </p>
                                <p>iv. Termination: This MEF shall remain in effect initially for a period of 1 (One) year from the date of signing. This MEF may be terminated cither by SSL or Merchant by providing written notice and explanation to either Merchant or SSL at least 30 (thirty) calendar days in advance of the effective date of termination. The termination of this MEF shall not affect the validity or the duration of activities under this MEF which are initiated prior to each termination.
                                </p>
                                <p>v. Review: This MEF shall be reviewed annually at one of the regularly scheduled meetings to determine continuing need and whether the MEF should be revised, renewed or cancelled.

                                </p>
                                <p>6.Shipment Policy
                                i. SSLCommerz doesn't allow any kind of drop shipment document(s). If merchant delivered the products outside then merchant should submit proper delivery copy (if any).
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')

@endsection
