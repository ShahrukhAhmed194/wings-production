<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Middleware\MembershipMiddleware;
use App\Http\Middleware\PayStatusMiddleware;
use App\Models\PaymentHistory;
use App\Models\User;
use App\Models\UserKid;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    use GeneralTrait;
    public function __construct()
    {
        $this->middleware(PayStatusMiddleware::class)->except('pay');
        $this->middleware(MembershipMiddleware::class)->except('form', 'formSubmit', 'userDashboard', 'successPayment','registrationFees', 'changePassword', 'changePasswordSubmit', 'pay');
        parent::__construct();
    }

    // Form
    public function form(){
        if(auth()->user()->status != 'before_submit'){
            return redirect()->route('userDashboard')->with('error-alert2', 'Sorry! Your membership form already submitted.');
        }
        $halls = $this->halls();
        $blood_groups = $this->blood_group();

        return view('front.user.form', compact( 'halls', 'blood_groups'));
    }
    public function formSubmit(Request $request){
        if(auth()->user()->status != 'before_submit'){
            return redirect()->route('userDashboard')->with('error-alert2', 'Sorry! Your membership form already submitted.');
        }
        //dd($request->all());
        $request->validate([
            'profile_image' => 'required',
            'last_name' => 'required|max:255',
            //'bengali_name' => 'required|max:255|regex:/[Å-ãk-~]/',
            //'nick_name' => 'required|max:255',
            'mobile_number' => 'required|max:11',
            'gender' => 'required',
            'blood_group' => 'required',
            'academic_session' => 'required|max:100',
            //'dob' => 'required',
            //'place_of_birth' => 'required|max:255',
            'facebook_link' => 'max:255',
            'father_name' => 'required|max:255',
            'n_id' => 'required|max:50',
            'mother_name' => 'required|max:191',
            'marital_status' => 'required',
            'mailing_address' => 'required|max:255',
            'mailing_city' => 'required|max:255',
            'mailing_district' => 'required|max:255',
            'mailing_post_code' => 'required|max:255',
            'mailing_country' => 'required|max:255',
            'contact_no_res' => 'max:255',
            'permanent_address' => 'required|max:255',
            'permanent_city' => 'required|max:255',
            'permanent_district' => 'required|max:255',
            'permanent_post_code' => 'required|max:255',
            'permanent_country' => 'required|max:255',
            'organization' => 'max:255',
            'organization_designation' => 'max:255',
            'organization_phone' => 'max:255',
            'organization_address' => 'max:255'
        ]);

        $data = $request->except(['profile_image','email','kid_name','member_type_id',
            'kid_dob','member_id_string','member_id','type','status','payment_status']);

        $user =auth()->user();

        if($request->file('profile_image')){
            if (env('RESTRICT_UPLOAD')) return redirect()->back()->with('error-alert', env('RESTRICT_UPLOAD_MESSAGE'));
            $file = $request->file('profile_image');
            $photo = time() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('/uploads/user');
            $file->move($destination, $photo);

            // Delete Old
            if($user->profile_image){
                $img = public_path() . '/uploads/user/' . $user->profile_image;
                if (file_exists($img)) {
                    unlink($img);
                }
            }

            $data +=[
                'profile_image'=>$photo
            ];
        }
        $data +=[
            'status'=>'pending'
        ];
        //dd($request->all());
        if($request->marital_status == 'Unmarried'){
            $data +=[
                'spouse_name'=>null,
                'spouse_dob'=>null,
            ];
        }else{
            $data +=[
                'spouse_name'=>$request->spouse_name,
                'spouse_dob'=>$request->spouse_dob,
            ];
            if($request->kid_name && count((array)$request->kid_name)){
                $kids=[];
                foreach((array)$request->kid_name as $key => $kid_name){
                    $kids[]=[
                        'user_id'=>$user->id,
                        'name'=>$kid_name,
                        'dob'=>isset($request->kid_dob[$key])?$request->kid_dob[$key]:null,
                        'created_at'=>now(),
                        'updated_at'=>now()
                    ];
                }
                try {
                    UserKid::insert($kids);
                }catch (\Exception $e){
                    //
                }
            }
        }
        try {
            $user->update($data);
        }catch (\Exception $e){
            //
        }
        return redirect()->route('user.pay')->with('success-alert2', 'Form submitted successfully. Please pay to active your membership.');
        //return redirect()->route('userDashboard')->with('success-alert2', 'Form submitted successfully. Please pay to active your membership.');
}

    public function pay(){
        if(auth()->user()->payment_status == 'unpaid'){
            return view('front.user.pay');
        }
        return redirect()->route('userDashboard')->with('error-alert2', 'Your payment status already paid.');

    }
    public function userDashboard(){
        if(auth()->user()->status == 'before_submit'){
            return redirect()->route('user.form')->with('error-alert2', 'Please submit membership form!');
        }

        return view('front.user.dashboard');
    }

    public function profileEdit(){
        $halls = $this->halls();
        $blood_groups = $this->blood_group();

        return view('front.user.profileEdit', compact( 'halls', 'blood_groups'));
    }

    public function profileUpdate(Request $request){
        $request->validate([
            'last_name' => 'required|max:255',
            'bengali_name' => 'required|max:255|regex:/[Å-ãk-~]/',
            'nick_name' => 'required|max:255',
            'academic_session' => 'required|max:100',
            'mobile_number' => 'required|max:11',
            'gender' => 'required',
            'blood_group' => 'required',
            //'dob' => 'required',
            'place_of_birth' => 'required|max:255',
            'facebook_link' => 'max:255',
            'father_name' => 'required|max:255',
            'n_id' => 'required|max:50',
            'mother_name' => 'required|max:191',
            'marital_status' => 'required',
            'mailing_address' => 'required|max:255',
            'mailing_city' => 'required|max:255',
            'mailing_district' => 'required|max:255',
            'mailing_post_code' => 'required|max:255',
            'mailing_country' => 'required|max:255',
            'contact_no_res' => 'max:255',
            'permanent_address' => 'required|max:255',
            'permanent_city' => 'required|max:255',
            'permanent_district' => 'required|max:255',
            'permanent_post_code' => 'required|max:255',
            'permanent_country' => 'required|max:255',
            'organization' => 'max:255',
            'organization_designation' => 'max:255',
            'organization_phone' => 'max:255',
            'organization_address' => 'max:255'
        ]);
        $data = $request->except(['profile_image','email','kid_name','member_type_id',
            'kid_dob','member_id_string','member_id','type','status','payment_status']);
        $user =auth()->user();

        if($request->file('profile_image')){
            if (env('RESTRICT_UPLOAD')) return redirect()->back()->with('error-alert', env('RESTRICT_UPLOAD_MESSAGE'));
            $file = $request->file('profile_image');
            $photo = time() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('/uploads/user');
            $file->move($destination, $photo);

            // Delete Old
            if($user->profile_image){
                $img = public_path() . '/uploads/user/' . $user->profile_image;
                if (file_exists($img)) {
                    unlink($img);
                }
            }
            $data +=[
                'profile_image'=>$photo
            ];
        }

        DB::table('user_kids')->where('user_id', $user->id)->delete();
        // dd($request->marital_status == 'Unmarried');
        if($request->marital_status == 'Unmarried'){
            $data +=[
                'spouse_name'=>null,
                'spouse_dob'=>null,
            ];
        }else{
            $data +=[
                'spouse_name'=>$request->spouse_name,
                'spouse_dob'=>$request->spouse_dob,
            ];
            // Kids
            if($request->kid_name && count((array)$request->kid_name)){
                $kids=[];
                foreach((array)$request->kid_name as $key => $kid_name){
                    $kids[]=[
                        'user_id'=>$user->id,
                        'name'=>$kid_name,
                        'dob'=>isset($request->kid_dob[$key])?$request->kid_dob[$key]:null,
                        'created_at'=>now(),
                        'updated_at'=>now()
                    ];
                }
                try {
                    UserKid::insert($kids);
                }catch (\Exception $e){
                    //
                }

            }
        }
        try {
            $user->update($data);
        }catch (\Exception $e){
            //
        }
        return redirect()->route('userDashboard')->with('success-alert2', 'Profile updated successfully.');
    }

    public function changePassword(){
        if(auth()->user()->status == 'before_submit'){
            return redirect()->route('user.form')->with('error-alert', 'Please submit membership form!');
        }

        return view('front.user.changePassword');
    }

    public function changePasswordSubmit(Request $request){
        if(auth()->user()->status == 'before_submit'){
            return redirect()->route('user.form')->with('error-alert', 'Please submit membership form!');
        }

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::findOrFail(auth()->user()->id);

        if(Hash::check($request->current_password, auth()->user()->password)){
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->back()->with('success-alert', 'Password changed successfully.');
        }
        return redirect()->back()->with('error-alert', 'Current password dose not match!');
    }

    public function registrationFees(){
        $payment_history = PaymentHistory::where('user_id', auth()->user()->id)->where('type', 'Registration Fee')->get();

        return view('front.user.registrationFees', compact('payment_history'));
    }

}
