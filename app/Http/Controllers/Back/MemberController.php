<?php

namespace App\Http\Controllers\Back;

use App\Exports\PaymentHistoryExport;
use App\Http\Controllers\Controller;
use App\Mail\UpdateNote;
use App\Models\MemberType;
use App\Models\PaymentHistory;
use App\Models\User;
use App\Models\UserKid;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\App;

class MemberController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $academic_sessions = User::where('academic_session','!=', null)->distinct('academic_session')->orderBy('academic_session','ASC')->pluck('academic_session');
        $member_types = MemberType::where('is_active',1)->orderBy('position','ASC')->get();
        return view('back.members.index', compact('academic_sessions','member_types'));
    }
    public function unpaidEdit(User $user)
    {
        $halls = $this->halls();
        $blood_groups = $this->blood_group();
        $member_types = MemberType::where(['is_active'=>1])->get();
        return view('back.members.unpaidEdit', compact('user',  'halls', 'blood_groups','member_types'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $halls = $this->halls();
        $blood_groups = $this->blood_group();
        $member_types = MemberType::where(['is_active'=>1])->get();

        //$last_user = User::latest('member_id')->first();

        return view('back.members.create', compact( 'halls', 'blood_groups','member_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'profile_image' => 'required|image|mimes:jpg,png,jpeg,gif',
            'last_name' => 'required|max:255',
            'email' => 'required|max:191|unique:users',
            // 'bangeli_name' => 'required|max:255|regex:/[Å-ãk-~]/',
            // 'nick_name' => 'required|max:255',
            // 'mobile_number' => 'required|max:11',
            // 'department' => 'required',
            // 'gender' => 'required',
            // 'blood_group' => 'required',
            // 'dob' => 'required',
            // 'place_of_birth' => 'required|max:255',
            // 'facebook_link' => 'max:255',
            // 'father_name' => 'required|max:255',
            //'n_id' => 'required|max:50',
            //'mother_name' => 'required|max:191',
            // 'marital_status' => 'required',
            // 'mailing_address' => 'required|max:255',
            // 'mailing_city' => 'required|max:255',
            // 'mailing_district' => 'required|max:255',
            // 'mailing_post_code' => 'required|max:255',
            // 'mailing_country' => 'required|max:255',
            // 'contact_no_res' => 'max:255',
            // 'permanent_address' => 'required|max:255',
            // 'permanent_city' => 'required|max:255',
            // 'permanent_district' => 'required|max:255',
            // 'permanent_post_code' => 'required|max:255',
            // 'permanent_country' => 'required|max:255',
            // 'organization' => 'required|max:255',
            // 'organization_designation' => 'required|max:255',
            // 'organization_phone' => 'required|max:255',
            // 'organization_address' => 'required|max:255',
            // 'status' => 'required',
            'payment_status' => 'required',
            'member_type_id' => 'required|exists:member_types,id',
            'amount' => 'required|numeric',
            'payment_trx_number' => 'max:255',
            'password' => 'required|min:6|confirmed'
        ]);
        $data = $request->except(['profile_image','kid_name',
            'kid_dob','member_id_string','member_id','type','status','password']);

        if($request->file('profile_image')){
            if (env('RESTRICT_UPLOAD')) return redirect()->back()->with('error-alert', env('RESTRICT_UPLOAD_MESSAGE'));
            $file = $request->file('profile_image');
            $photo = time() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('/uploads/user');
            $file->move($destination, $photo);
            $data +=[
                'profile_image'=>$photo
            ];
        }
        $data +=[
            'password'=>Hash::make($request->password),
            'status'=>'approved',
        ];
        $user = User::create($data);
        // Insert User Kids
        if($request->marital_status != 'Unmarried'){
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
                        'dob'=>$request->kid_dob[$key],
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

        $mm=User::where('member_id','!=',null)->orderBy('member_id','DESC')->first(['member_id']);
        $u_member_id=1;
        if (isset($mm->member_id)) $u_member_id =$mm->member_id+1;
        $data +=[
            'member_id'=>$u_member_id,
            'member_id_string'=>$this->generateCustomID($u_member_id),
        ];
        $payment_date = [
            'user_id'=>$user->id,
            'amount'=>$request->amount,
            'status'=>'success',
            'trx_id'=>$request->payment_trx_number,
            'type'=>'Registration Fee',
        ];
        try{
            $user->update($data);
            PaymentHistory::create($payment_date);
        }catch (\Exception $e){
            //
        }


        $subject = 'Welcome to ' . env('APP_NAME');
        $name = $user->full_name;
        $email = $user->email;
        //cache info forget
        Cache::forget('members');
        try{
            Mail::to($user->email)->bcc(env('ADMIN_NOTIFY_MAIL'))->send(new WelcomeMail($subject, $name, $email));
        }catch (\Exception $e){
            ///
        }

        return redirect()->back()->with('success-alert', 'Member created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $halls = $this->halls();
        $blood_groups = $this->blood_group();
        $member_types = MemberType::where(['is_active'=>1])->get();

        return view('back.members.edit', compact('user',  'halls', 'blood_groups','member_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'last_name' => 'required|max:255',
            'email' => 'required|max:191|unique:users,email,' . $id,
            // 'bengali_name' => 'required|max:255|regex:/[Å-ãk-~]/',
            // 'nick_name' => 'required|max:255',
            // 'mobile_number' => 'required|max:11',
            // 'department' => 'required',
            // 'gender' => 'required',
            // 'blood_group' => 'required',
            // 'dob' => 'required',
            // 'place_of_birth' => 'required|max:255',
            // 'facebook_link' => 'max:255',
            // 'father_name' => 'required|max:255',
            // 'marital_status' => 'required',
            // 'mailing_address' => 'required|max:255',
            // 'mailing_city' => 'required|max:255',
            // 'mailing_district' => 'required|max:255',
            // 'mailing_post_code' => 'required|max:255',
            // 'mailing_country' => 'required|max:255',
            // 'contact_no_res' => 'max:255',
            // 'permanent_address' => 'required|max:255',
            // 'permanent_city' => 'required|max:255',
            // 'permanent_district' => 'required|max:255',
            // 'permanent_post_code' => 'required|max:255',
            // 'permanent_country' => 'required|max:255',
            // 'organization' => 'required|max:255',
            // 'organization_designation' => 'required|max:255',
            // 'organization_phone' => 'required|max:255',
            // 'organization_address' => 'required|max:255',
            //'payment_status' => 'required',
            'member_type_id' => 'required|exists:member_types,id',
            'amount' => 'numeric',
            'payment_trx_number' => 'max:255',
            'update_note' => 'required'
        ]);

        $user = User::findOrFail($id);
        $data=$request->except(['profile_image','kid_name',
            'kid_dob','member_id_string','member_id','type']);
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

        // Insert Membership ID
        if($request->status == 'approved' && !$user->member_id){
            $mm=User::where('member_id','!=',null)->orderBy('member_id','DESC')->first(['member_id']);
            $u_member_id=1;
            if (isset($mm->member_id)) $u_member_id =$mm->member_id+1;
            $data +=[
                'member_id'=>$u_member_id,
                'member_id_string'=>$this->generateCustomID($u_member_id),
            ];
        }

        // Insert/Update User Kids/Spouse
        DB::table('user_kids')->where('user_id', $id)->delete();
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

            if($request->kid_name && count($request->kid_name)){
                $kids=[];
                foreach((array)$request->kid_name as $key => $kid_name){
                    $kids[]=[
                        'user_id'=>$user->id,
                        'name'=>$kid_name,
                        'dob'=>$request->kid_dob[$key],
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
        $payment_date = [
            'user_id'=>$user->id,
            'amount'=>$request->amount,
            'status'=>'success',
            'trx_id'=>$request->payment_trx_number,
            'type'=>'Registration Fee',
        ];
        try {
            //cache info forget
            Cache::forget('members');
            $user->update($data);
            if($request->input('amount')) PaymentHistory::create($payment_date);
        }catch (\Exception $e){
            //
        }

        // Send update notify email
        $subject = 'Member information updated';
        $content = $user->update_note;
        try {
            //Mail::to(env('ADMIN_NOTIFY_MAIL'))->send(new UpdateNote($subject, $content, $user->full_name));
            Mail::to($user->email)->send(new UpdateNote($subject, $content));
        }catch (\Exception $e){
            //
        }


        return redirect()->back()->with('success-alert', 'Member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function report(Request $request){
        $users = User::query();
        if($request->id_range){
            $idrangev = $request->id_range;
            $idRange = explode("-", $request->id_range);
            $start_id = $idRange[0] ?? null;
            $end_id = $idRange[1] ?? null;

            if($start_id){
                $users->where('member_id', '>=', $start_id);
            }
            if($end_id){
                $users->where('member_id', '<=', $end_id);
            }
        }

        if($request->status){
            $users->where('status', $request->status);
        }
        if($request->city){
            $users->where('mailing_city', $request->city);
        }
        $users = $users->where('payment_status', 'paid')->where('member_id', '!=', null)->get();

        if($request->action == 'pdf'){
            $html = view('back.members.pdfReport', compact('users'))->render();

            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($html)->setPaper('a4', 'landscape');
            return $pdf->stream();
        }elseif($request->action == 'excel'){
            return Excel::download(new UsersExport($users), 'Member_Report_'. date("Y-m-d-H-i-s") .'.xlsx');
        }
        return view('back.members.report', compact( 'users'));
    }
    public function paymentReport(Request $request){
        $payments = PaymentHistory::query();
        if($request->status){
            $payments->where('status', $request->status);
        }
        if($request->trx_id){
            $payments->where('trx_id', $request->trx_id);
        }
        if($request->nagad_tnx_id){
            $payments->where('nagad_tnx_id', $request->nagad_tnx_id);
        }
        $payments = $payments->where('type','Registration Fee')->orderBy('id','DESC')->get();
        if($request->action == 'pdf'){
            $html = view('back.members.pdfReportPayment', compact('payments'))->render();

            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($html)->setPaper('a4', 'landscape');
            return $pdf->stream();
        }elseif($request->action == 'excel'){
            return Excel::download(new PaymentHistoryExport($payments), 'Payment_Report_'. date("Y-m-d-H-i-s") .'.xlsx');
        }
        return view('back.members.paymentReport', compact( 'payments'));
    }

    public function membersTable(Request $request){
        //return response()->json($request->all());
        // Get Data
        $columns = array(
            0 => 'id',
            1 => 'name',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $status = $request->status ?? 'All';
        $payment_status = $request->payment_status ?? null;
        $member_type = $request->member_type ?? null;
        $ac_session = $request->ac_session ?? null;

        $query = User::query();
        $query->where(['type'=>'member'])->where('status','!=','before_submit');
        if($status != 'All'){
            $query->where('status', $status);
            if ($status == 'pending') $query->where('payment_status', 'paid');
        }
        if ($payment_status){
            $query->where('payment_status', $payment_status);
        }
        if ($member_type){
            $query->where('member_type_id', $member_type);
        }
        if ($ac_session){
            $query->where('academic_session', $ac_session);
        }
        $query->with('memberType');

        //$query->where('member_id','!=',null);

        // Search
        if($request->input('search.value')){
            $search = $request->input('search.value');

            $query->whereLike(['member_id_string','email','first_name',
                'last_name','academic_session','blood_group','memberType.name'],$search);
        }
        $query->orderBy('member_id','desc');
        // Count Items
        $totalFiltered = $query->count();
        if($limit == "-1"){
            $query->skip($start)->limit($totalFiltered);
        }else{
            $query->skip($start)->limit($limit);
        }
        $order = 'users.'. $order;
        $query = $query->orderBy($order, $dir)->get();

        $output = array();
        foreach ($query as $key => $data) {
            $nestedData['sl'] = ($start + $key) + 1;
            if($dir == 'desc'){
                $nestedData['sl_desc'] = $totalFiltered - ($start + $key);
            }else{
                $nestedData['sl_desc'] = ($start + $key) + 1;
            }
            $nestedData['id'] = $data->id;
            $nestedData['blank'] = "";
            $nestedData['member_id_string'] = $data->member_id_string;
            $nestedData['date'] = Carbon::parse($data->created_at)->format('d-m-Y');
            $nestedData['name'] = $data->full_name;
            $nestedData['email'] = $data->email;
            $nestedData['phone_number'] = $data->mobile_number;
            $nestedData['type'] = $data->memberType?$data->memberType->name:'';
            $nestedData['academic_session'] = $data->academic_session;
            $nestedData['blood_group'] = $data->blood_group;
            $nestedData['approval_status'] = $data->status;
            $nestedData['payment_status'] = $data->payment_status;
            $action = null;
            $approve_message= "return confirm('Are you sure to approve?')";
            $cancel_message= "return confirm('Are you sure to cancel?')";
            if($data->payment_status == 'unpaid'){
                $action =  '<a class="btn btn-info btn-sm" href="'. route('back.member.unpaid.edit', $data->id) .'"><i class="fas fa-edit"></i></a>';
            }else{
                $action .=  '<a class="btn btn-info btn-sm" href="'. route('back.members.edit', $data->id) .'"><i class="fas fa-edit"></i></a>';
            }
            if ($data->payment_status == 'paid' && $data->status != 'approved'){
                $action .=
                    '<form class="d-inline-block" action="'.route('back.member.approveOrCancel', [$data->id,'approve']).'" method="POST">
                '.method_field('POST') . csrf_field().'
                    <button class="btn btn-success btn-sm ml-1" onclick="'.$approve_message.'") type="submit">Approve</button>
                </form>';
                $action .=
                    '<form class="d-inline-block" action="'.route('back.member.approveOrCancel', [$data->id,'cancel']).'" method="POST">
                '.method_field('POST') . csrf_field().'
                    <button class="btn btn-danger btn-sm ml-1" onclick="'.$cancel_message.'") type="submit">Cancel</button>
                </form>';
            }
            $nestedData['action'] = $action;
            $output[] = $nestedData;
        }

        // Output
        $output = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalFiltered),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $output
        );
        return response()->json($output);
    }

    public function approveOrCancel(Request $request, User $user, $status)
    {
        if ($user->payment_status == 'paid'){
            // Send update notify email
            $subject = '';
            $content = '';

            if ($status == 'approve'){
                $mm=User::where('member_id','!=',null)->orderBy('member_id','DESC')->first(['member_id']);
                $u_member_id=1;
                if (isset($mm->member_id)) $u_member_id =$mm->member_id+1;

                $user->update([
                    'status'=>'approved',
                    'member_id'=>$u_member_id,
                    'member_id_string'=>$this->generateCustomID($u_member_id),
                ]);
                $subject = env('APP_NAME').' Membership approval Notification';
                $content = "Your membership request is approved. Your membership id is $user->member_id_string";
            }elseif ($status == 'cancel'){
                $user->update(['status'=>'canceled']);
                $subject = env('APP_NAME').' Membership cancel Notification';
                $content = "We are sorry to say that your membership request is canceled.";
            }
            try {
                dispatch(new \App\Jobs\DefaultJob($user->email,$subject, $content, $user->last_name))->delay(now()->addSeconds(5));
                //Mail::to($user->email)->send(new UpdateNote($subject, $content, $user->last_name));
            }catch (\Exception $e){
                //
            }
            return redirect()->back()->with('success-alert','Status update successfully');
        }
        return redirect()->back()->with('error-alert','Invalid request');
    }

}
