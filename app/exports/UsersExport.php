<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    protected $users;

	 function __construct($users)
	 {
		$this->users = $users;
	 }


	 public function collection()
	 {
		 return $this->users;
	 }

	 public function view(): View
	 {
		return view('back.members.excelReport')->with('users', $this->users);
	 }

}
