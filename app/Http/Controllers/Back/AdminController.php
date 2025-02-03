<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('type', 'admin')->where('id','!=',auth()->id())->get();
        return view('back.admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $v_data = [
            'last_name' => 'required|max:255',
            'mobile_number' => 'required|max:255|unique:users',
            'email' => 'required|max:255|unique:users,email',
            'address' => 'required',
            'password' => 'required|min:8|confirmed',
        ];
        if($request->file('profile_image')){
            if (env('RESTRICT_UPLOAD')) return redirect()->back()->with('error-alert', env('RESTRICT_UPLOAD_MESSAGE'));
            $v_data['profile_image'] = 'mimes:jpg,png,jpeg,gif';
        }

        $request->validate($v_data);
        $data = $request->only(['last_name','mobile_number','email','address',]);
        $data +=[
            'type'=>'admin',
            'password'=>Hash::make($request->password),
        ];
        if($request->file('profile_image')){
            $image = $request->file('profile_image');
            $filename    = time() . '.' . $image->getClientOriginalExtension();

            // Resize Image 150*150
            $image_resize = Image::make($image->getRealPath());
            $image_resize->fit(150, 150);
            $image_resize->save(public_path('/uploads/user/' . $filename));
            $data +=[
                'profile_image'=>$filename
            ];
        }
        User::create($data);

        return redirect()->back()->with('success-alert', 'Admin created successfully.');
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
        // dd($user);
        return view('back.admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = Validator::make($request->all(),[
            'last_name' => 'required|max:255',
            'mobile_number' => 'required|max:255|unique:users,mobile_number,' . $user->id,
            'email' => 'required|max:255|unique:users,email,' . $user->id,
            'address' => 'required',
            'profile_image' => 'image|mimes:jpg,png,jpeg,gif',
            'password' => 'min:8|confirmed',
        ])->validate();

        if($request->password){
            $password = $data['password'];
            unset($data['password']);
            $data += [
                'password'=>Hash::make($password),
            ];
        }

        if($request->file('profile_image')){
            if (env('RESTRICT_UPLOAD')) return redirect()->back()->with('error-alert', env('RESTRICT_UPLOAD_MESSAGE'));
            unset($data['profile_image']);
            $image = $request->file('profile_image');
            $filename    = time() . '.' . $image->getClientOriginalExtension();

            // Resize Image 150*150
            $image_resize = Image::make($image->getRealPath());
            $image_resize->fit(150, 150);
            $image_resize->save(public_path('/uploads/user/' . $filename));

            // Delete old
            if($user->profile){
                $img = public_path() . '/uploads/user/' . $user->profile_image;
                if (file_exists($img)) {
                    unlink($img);
                }
            }
            $data += [
                'profile_image'=>$filename,
            ];
        }
        $user->update($data);

        return redirect()->back()->with('success-alert', 'Admin updated successfully.');
    }

    public function update_profile_page(){
        $user = User::where('id', Auth::user()->id)->first();
        return view('back.admin.edit-admin')->with('user', $user);
    }

    public function update_profile(Request $request){
        $data = Validator::make($request->all(),[
            'last_name' => 'required|max:255',
            'mobile_number' => 'required|max:255|unique:users,mobile_number,' . auth()->id(),
            'email' => 'required|max:255|unique:users,email,' . auth()->id(),
            'address' => 'required',
            'profile_image' => 'image|mimes:jpg,png,jpeg,gif',
            'password' => 'min:8|confirmed',
        ])->validate();
        $user = auth()->user();
        if($request->password){
            $password = $data['password'];
            unset($data['password']);
            $data += [
                'password'=>Hash::make($password),
            ];
        }
        if($request->file('profile_image')){
            if (env('RESTRICT_UPLOAD')) return redirect()->back()->with('error-alert', env('RESTRICT_UPLOAD_MESSAGE'));
            unset($data['profile_image']);
            $image = $request->file('profile_image');
            $filename    = time() . '.' . $image->getClientOriginalExtension();

            // Resize Image 150*150
            $image_resize = Image::make($image->getRealPath());
            $image_resize->fit(150, 150);
            $image_resize->save(public_path('/uploads/user/' . $filename));

            // Delete old
            if($user->profile){
                $img = public_path() . '/uploads/user/' . $user->profile_image;
                if (file_exists($img)) {
                    unlink($img);
                }
            }
            $data += [
                'profile_image'=>$filename,
            ];
        }
        $user->update($data);

        return redirect()->back()->with('success-alert', 'Profile updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if($user->id == auth()->id()){
            return redirect()->back()->with('error-alert', 'Sorry! You can not delete your own account!');
        }

        // Delete Image
        if($user->image){
            $img = public_path() . '/uploads/user/' . $user->image;
            if (file_exists($img)) {
                unlink($img);
            }
        }

        $user->delete();

        return redirect()->back()->with('success-alert', 'Admin deleted successfully.');
    }

    public function update_password(Request $request) {
        $request->validate([
            'old_password' => 'required|min:8',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if(Hash::check($request->old_password, $user->password)){
            $user->update(['password'=>Hash::make($request->password)]);

            return redirect()->back()->with('success-alert', 'Password updated successfully.');
        }
        return redirect()->back()->with('error-alert', 'Old password dose not match!');
    }
}
