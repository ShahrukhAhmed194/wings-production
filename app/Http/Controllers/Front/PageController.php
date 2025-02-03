<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CommitteeMember;
use App\Models\Festival;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Page;
use App\Models\SecondGalleryCategory;
use App\Models\SecondGalleryItem;
use App\Models\Slider;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    use GeneralTrait;
    // Homepage
    public function homepage()
    {
        $sliders = Cache::remember('sliders', now()->addDays(30), function () {
            return Slider::active()->get();
        });
        $galleries = Cache::remember('galleries', now()->addDays(30), function () {
            return Gallery::take(3)->active()->get();
        });
        $news = Cache::remember('news', now()->addDays(15), function () {
            return News::active()->orderBy('id','DESC')->take(4)->get();
        });
       // $events = Cache::remember('events', now()->addDays(30), function () {
          //  return Festival::active()->take(3)->get();
            $events = Festival::active()->take(3)->get();
        //});
        //$news = News::active()->orderBy('id','DESC')->take(4)->get();
        //$events = Festival::active()->take(3)->get();
        //$notices = Notice::where('status',1)->orderBy('id','DESC')->take(5)->get();
        return view('front.homepage', compact('sliders','news','events','galleries'));
    }
    public function contactUsSubmit(Request $request){
        $request->validate([
            'full_name' => 'required',
            'email' => 'required',
            'mobile_number' => 'required',
            'message' => 'required',
            'captcha' => 'required|captcha'
        ]);

        if(!env('APP_MAIL_STATUS')){
            return redirect()->back()->with('error', 'Send email disabled!');
        }

        try {
            dispatch(new \App\Jobs\ContactUsJob($request->full_name, $request->email, $request->mobile_number, $request->message))->delay(now()->addSeconds(5));
        }catch (\Exception $e){
            //
        }

        return redirect()->back()->with('success', 'Thanks for contacting with us. We will reply you within short time.');
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->active()->firstOrFail();
        if($page->template){
            return view('front.' . $page->template);
        }
        return view('front.page', compact('page'));
    }
    
    public function newsDetails(News $news){
        $recent_news = News::active(20)->get();
        return view('front.news.details', compact('news', 'recent_news'));
    }

    public function imageUpload(Request $request){
        // CK Editor function ===============================================
        $image       = $request->file('upload');
        $filename    = time() . '.' . $image->getClientOriginalExtension();
        $destination = public_path() . '/uploads/image';
        $image->move($destination, $filename);

        $url = asset('uploads/image/' . $filename);

        return response()->json([
            'fileName' => $filename,
            'uploaded' => true,
            'url' => $url,
        ]);
    }
    public function memberDetails($user){
        if(!auth()->check()){
            abort(403);
        }

        $user = User::where('member_id', '!=', null)->active()->findOrFail($user);

        return view('front.memberDetails', compact('user'));
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
        $query = User::query();
        $query->with('memberType');
        $query->where('status','approved');
        $query->where('member_id','!=',null);
        //whereLikedd($query->get());
        // Search
        if($request->input('search.value')){
            $search = $request->input('search.value');

            $query->whereLike(['member_id_string','email','first_name',
                'last_name','academic_session','blood_group','memberType.name'],$search);
        }
        $query->orderBy('member_id','asc');
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
            $nestedData['member_id_string'] = $data->member_id_string;
            $nestedData['name'] = $data->full_name;
            $nestedData['email'] = $data->email;
            $nestedData['type'] = $data->memberType?$data->memberType->name:'';
            $nestedData['academic_session'] = $data->academic_session;
            //$nestedData['number_of_person'] = $data->number_of_person;
            $nestedData['blood_group'] = $data->blood_group;
            $nestedData['action'] = auth()->check() ?'<a class="btn btn-sm btn-success" href="'. route('memberDetails', $data->id) .'">View Details</a>':'';
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

    public function gallery(Gallery $gallery){
        return view('front.gallery', compact('gallery'));
    }

    public function committeeMember($id){
        $member = CommitteeMember::findOrFail($id);

        return view('front.committeeMember', compact('member'));
    }
}
