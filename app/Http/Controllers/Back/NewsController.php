<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Repositories\MediaRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::latest('id')->get();

        return view('back.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.news.create');
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

        if($request->file('image')){
            $v_data['image'] = 'mimes:jpg,png,jpeg,gif';
        }

        $request->validate($v_data);

        $news = new News;
        $news->title = $request->title;
        $news->short_description = $request->short_description;
        $news->description = $request->description;
        $news->meta_title = $request->meta_title;
        $news->meta_description = $request->meta_description;
        $news->meta_tags = $request->meta_tags;

        if($request->file('image')){
            if (env('RESTRICT_UPLOAD')) return redirect()->back()->with('error-alert', env('RESTRICT_UPLOAD_MESSAGE'));
            $uploaded_file = MediaRepo::upload($request->file('image'));
            $news->image = $uploaded_file['full_file_name'];
            $news->media_id = $uploaded_file['media_id'];
        }

        $news->save();
        //cache info forget
        Cache::forget('news');
        return redirect()->back()->with('success-alert', 'News created successfully.');
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
    public function edit(News $news)
    {
        return view('back.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $v_data = [
            'title' => 'required|max:255',
            'description' => 'required'
        ];

        if($request->file('image')){
            $v_data['image'] = 'mimes:jpg,png,jpeg,gif';
        }

        $request->validate($v_data);

        $news->title = $request->title;
        $news->short_description = $request->short_description;
        $news->description = $request->description;
        $news->meta_title = $request->meta_title;
        $news->meta_description = $request->meta_description;
        $news->meta_tags = $request->meta_tags;

        if($request->file('image')){
            if (env('RESTRICT_UPLOAD')) return redirect()->back()->with('error-alert', env('RESTRICT_UPLOAD_MESSAGE'));
            $uploaded_file = MediaRepo::upload($request->file('image'));
            $news->image = $uploaded_file['full_file_name'];
            $news->media_id = $uploaded_file['media_id'];
        }

        $news->save();
        //cache info forget
        Cache::forget('news');
        return redirect()->back()->with('success-alert', 'News updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();
        //cache info forget
        Cache::forget('news');
        return redirect()->back()->with('success-alert', 'News deleted successfully.');
    }
}
