<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest')->except('redirect');
    }

    // Login
    public function login()
    {
        return view('front.auth.login');
    }

    public function register()
    {
        return view('front.auth.register');
    }

    public function registerSubmit(Request $request)
    {
        $request->validate([
            'member_type_id' => 'required|not_in:0|exists:member_types,id',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);
        /*
        try {
            $user->notify(new EmailVerificationMail($user->id));
        }catch (\Exception $e){
            //
        }*/
        $data = $request->only(['member_type_id','email']);
        $data +=['last_name'=>$request->name];

        $data +=[
            'password'=>Hash::make($request->password),
            'status'=>'before_submit'
        ];
        try {
            $user = User::create($data);
            Auth::login($user);

            if(auth()->user()->status == 'before_submit'){
                return redirect()->route('user.form');
            }
        }catch (\Exception $e){
            //
        }
        return redirect()->route('userDashboard');
    }

    /*public function emailVerify($id)
    {
        $user = PreUser::findOrFail($id);

        return view('front.auth.emailVerify', compact('user'));
    }

    public function resendVerifyLink($id)
    {
        $user = PreUser::findOrFail($id);
        $user->notify(new EmailVerificationMail($id));

        return redirect()->back()->with('success-alert', 'Email verification link send successfully.');
    }

    public function emailVerifyCheck($id)
    {

        $pre_user = PreUser::find($id);
        if(!$pre_user){
            return redirect()->route('homepage')->with('error-alert2', 'Sorry! Verification link invalid or verified.');
        }

        $user = new User;
        $user->last_name = $pre_user->name;
        $user->email = $pre_user->email;
        $user->mobile_number = $pre_user->mobile_number;
        $user->password = $pre_user->password;
        $user->status = 'before_submit';
        $user->save();

        // Delete History
        DB::table('pre_users')->where('email', $pre_user->email)->delete();
        DB::table('pre_users')->where('mobile_number', $pre_user->mobile_number)->delete();

        Auth::login($user);

        if(auth()->user()->status == 'before_submit'){
            return redirect()->route('user.form');
        }
        return redirect()->route('userDashboard');
    }*/

    public function redirect()
    {
        if (auth()->check()) {
            if (auth()->user()->type == 'admin') {
                return redirect()->intended(route('dashboard'));
            }
            return redirect()->intended(route('userDashboard'));
        }

        return redirect()->route('homepage');
    }
}
