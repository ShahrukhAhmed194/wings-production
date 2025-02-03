<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\CommitteeMember;
use App\Models\Notification\Email;
use App\Models\Notification\Push;
use App\Models\User;
use App\Repositories\MediaRepo;
use App\Repositories\NotificationRepo;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Email
    public function email(){
        $emails = Email::latest('id')->get();

        return view('back.notification.email', compact('emails'));
    }

    public function emailSend(){
        return view('back.notification.emailSend');
    }

    public function emailSendSubmit(Request $request){
        $request->validate([
            'send_mail_to' => 'required',
            'subject' => 'required|max:255',
            'body' => 'required',
        ]);

        if(!env('APP_MAIL_STATUS')){
            return redirect()->back()->with('error-alert', 'Send email disabled!');
        }

        // Generate customers, emails and send
        $customers = array();
        $emails = array();
        if($request->send_mail_to == 'Selected Member'){
            foreach((array)$request->customers as $customer){
                $user = User::find($customer);
                if($user && $user->email){
                    NotificationRepo::sendEmailToUser($user, $request->subject, $request->body);

                    $customers[] = $user->id;
                    $emails[] = $user->email;
                }
            }
        }else{
            if($request->send_mail_to == 'Executive Committee'){
                $users = CommitteeMember::get();

                foreach($users as $user){
                    if($user->User && $user->User->email){
                        NotificationRepo::sendEmailToUser($user->User, $request->subject, $request->body);

                        $customers[] = $user->id;
                        $emails[] = $user->email;
                    }
                }
            }else{
                $users = User::orderBy('id', 'asc')->where(['status'=>'approved'])->get();

                foreach ($users as $user) {
                    NotificationRepo::sendEmailToUser($user, $request->subject, $request->body);
                }
            }
        }
        if (count($customers)){
            $email = new Email;
            $email->subject = $request->subject;
            $email->body = $request->body;
            $email->customers = json_encode($customers);
            $email->emails = json_encode($emails);
            $email->save();
        }

        return redirect()->back()->with('success-alert', 'Email send successfully.');
    }

    public function emailShow(Email $email){
        return view('back.notification.emailShow', compact('email'));
    }

    public function push(){
        $pushes = Push::latest('id')->get();

        return view('back.notification.push', compact('pushes'));
    }
    public function pushSend(Request $request){
        $request->validate([
            'text' => 'required|max:255',
            'url' => 'max:255'
        ]);

        $push = new Push;
        $push->text = $request->text;
        $push->url = $request->url;

        if($request->file('image')){
            $uploaded_file = MediaRepo::upload($request->file('image'));
            $push->image = $uploaded_file['file_name'];
            $push->image_path = $uploaded_file['file_path'];
            $push->media_id = $uploaded_file['media_id'];
        }

        $push->save();

        if($push->image){
            $image = $push->img_paths['large'];
        }else{
            $image = null;
        }

        NotificationRepo::sendOneSignal($push->text, $push->url, $image);

        return redirect()->back()->with('success-alert', 'Push send successfully.');
    }

    public function selectList(Request $request){
        $search = $request->q;
        $users = User::where(function($q) use ($search){
            $q->where('id', $search)->orWhere('first_name', 'LIKE', "%{$search}%")->orWhere('last_name', 'LIKE', "%{$search}%");
        })->where('member_id', '!=', null)->get();

        // Output
        $output = array();
        foreach ($users as $user){
            $output[] = ['id' => $user->id, 'text' => ($user->full_name . '- ' . $user->member_id_string)];
        }

        return response()->json($output);
    }
}
