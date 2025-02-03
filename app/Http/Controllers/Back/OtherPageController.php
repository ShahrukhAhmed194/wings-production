<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\User;

class OtherPageController extends Controller
{
    public function dashboard(){
        $pending_members = User::where('type', 'member')->where('status', 'pending')->where('payment_status', 'paid')->count();
        $active_members = User::active('id', 'member')->where('member_id', '!=', null)->count();
        $canceled_members = User::where('type', 'member')->where('status', 'canceled')->where('payment_status', 'paid')->where('member_id', '!=', null)->count();
        $unpaid_members = User::where('type', 'member')->where('payment_status', 'unpaid')->where('status','!=','before_submit')->count();
        $all_members = User::where('payment_status', 'paid')->where('member_id', '!=', null)->count();

        return view('back.dashboard', compact('pending_members', 'active_members', 'canceled_members', 'all_members','unpaid_members'));
    }
}
