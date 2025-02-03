<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Committee;
use App\Models\CommitteeMember;
use App\Models\User;
use App\Repositories\MediaRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $committees = Committee::latest('id')->get();

        return view('back.committees.index', compact('committees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'short_description' => '',
        ])->validate();

        Committee::create($data);

        return redirect()->back()->with('success-alert', 'Committee created successfully.');
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
    public function edit(Committee $committee)
    {
        return view('back.committees.edit', compact('committee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Committee $committee)
    {
        $data = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'short_description' => '',
        ])->validate();
        $committee->update($data);

        return redirect()->back()->with('success-alert', 'Committee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Committee $committee)
    {
        $committee->delete();

        return redirect()->back()->with('success-alert', 'Committee deleted successfully.');
    }

    public function memberCreate(Committee $committee){
        $users = User::where('member_id', '!=', null)->active()->get();

        return view('back.committees.memberCreate', compact('committee', 'users'));
    }

    public function memberStore(Committee $committee, Request $request){

        $data = Validator::make($request->all(),[
            'member' => 'required',
            'designation' => 'required|max:255',
            'position' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif',
        ])->validate();
        $data +=[
            'user_id'=>$data['member'],
            'committee_id'=>$committee->id,
        ];
        if($request->file('image')){
            if (env('RESTRICT_UPLOAD')) return redirect()->back()->with('error-alert', env('RESTRICT_UPLOAD_MESSAGE'));
            $uploaded_file = MediaRepo::upload($request->file('image'));
            $data +=[
                'image'=>$uploaded_file['full_file_name'],
                'media_id'=>$uploaded_file['media_id'],
            ];
        }

        CommitteeMember::create($data);

        return redirect()->route('back.committees.edit', $committee->id)->with('success-alert', 'Committee member created successfully.');
    }

    public function memberDestroy($id){
        $committeeMember = CommitteeMember::findOrFail($id);
        $committeeMember->delete();

        return redirect()->back()->with('success-alert', 'Committee member deleted successfully.');
    }

    public function memberEdit($id){
        $committeeMember = CommitteeMember::findOrFail($id);
        $users = User::where('member_id', '!=', null)->active()->get();

        return view('back.committees.memberEdit', compact('committeeMember', 'users'));
    }

    public function memberUpdate($id, Request $request){
        $committeeMember = CommitteeMember::findOrFail($id);

        $v_data = [
            'designation' => 'required|max:255',
            'position' => 'required',
            'description' => 'required',
        ];

        if($request->file('image')){
            $v_data['image'] = 'mimes:jpg,png,jpeg,gif';
        }

        $request->validate($v_data);

        $committeeMember->designation = $request->designation;
        $committeeMember->position = $request->position;
        $committeeMember->description = $request->description;

        if($request->file('image')){
            if (env('RESTRICT_UPLOAD')) return redirect()->back()->with('error-alert', env('RESTRICT_UPLOAD_MESSAGE'));
            $uploaded_file = MediaRepo::upload($request->file('image'));
            $committeeMember->image = $uploaded_file['full_file_name'];
            $committeeMember->media_id = $uploaded_file['media_id'];
        }

        $committeeMember->save();

        return redirect()->route('back.committees.edit', $committeeMember->committee_id)->with('success-alert', 'Committee member updated successfully.');
    }
}
