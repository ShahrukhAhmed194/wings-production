<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class PaymentHistoryExport implements FromView
{
    protected $payments;

	 function __construct($payments)
	 {
		$this->payments = $payments;
	 }


	 public function collection()
	 {
		 return $this->payments;
	 }

	 public function view(): View
	 {
		return view('back.members.excelReportPayment')->with('payments', $this->payments);
	 }

}
