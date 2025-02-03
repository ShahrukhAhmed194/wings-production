<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\BulkEmailSend;
use Illuminate\Support\Facades\Cache;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices = Notice::latest('id')->get();

        return view('back.notice.index', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.notice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v_data = [
            'title' => 'required|max:255',
            'description' => 'required'
        ];

        $request->validate($v_data);

        $notice = new Notice;
        $notice->title = $request->title;
        $notice->description = $request->description;
        $notice->send_mail_to = $request->send_mail_to;
        $notice->save();
        //cache info forget
        Cache::forget('notices');
        // Send Mail
        if ($request->send_mail_to == 'All') {
            $users = User::orderBy('id', 'asc')->active()->get();

            foreach ($users as $user) {
                $user->notify(new BulkEmailSend($notice->title, $notice->description));
            }
        }
        //  else {
        //     $committee = Committee::latest('id')->first();
        //     $members = $committee->CommitteeMember;

        //     foreach ($members as $member) {
        //         $member->Member->notify(new BulkEmailSend($request));
        //     }
        // }

        return redirect()->back()->with('success-alert', 'Notice created successfully.');
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
     * @return \Illuminate\Http\Response
     */
    public function edit(Notice $notice)
    {
        return view('back.notice.edit', compact('notice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notice $notice)
    {
        $v_data = [
            'title' => 'required|max:255',
            'description' => 'required'
        ];

        $request->validate($v_data);

        $notice->title = $request->title;
        $notice->description = $request->description;

        $notice->save();
        //cache info forget
        Cache::forget('notices');
        return redirect()->back()->with('success-alert', 'Notice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice)
    {
        $notice->delete();
        //cache info forget
        Cache::forget('notices');
        return redirect()->back()->with('success-alert', 'Notice deleted successfully.');
    }
}
