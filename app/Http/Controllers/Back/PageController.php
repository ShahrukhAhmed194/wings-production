<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Repositories\MediaRepo;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::latest('id')->get();

        return view('back.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.page.create');
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
            'title' => 'required|max:255'
        ];

        if($request->file('image')){
            $v_data['image'] = 'mimes:jpg,png,jpeg,gif';
        }

        $request->validate($v_data);

        $page = new Page;
        $page->title = $request->title;

        $page->short_description = $request->short_description;
        $page->description = $request->description;
        $page->meta_title = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->meta_tags = $request->meta_tags;
        $page->template = $request->template;

        if($request->file('image')){
            $uploaded_file = MediaRepo::upload($request->file('image'));
            $page->image = $uploaded_file['full_file_name'];
            $page->media_id = $uploaded_file['media_id'];
        }

        $page->save();

        return redirect()->back()->with('success-alert', 'Page created successfully.');
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
    public function edit(Page $page)
    {
        return view('back.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|max:255'
        ]);

        $page->title = $request->title;

        if($page->title != $request->title){
            $slug = SlugService::createSlug(Page::class, 'slug', $request->title);
            $page->slug = $slug;
        }

        $page->short_description = $request->short_description;
        $page->description = $request->description;
        $page->meta_title = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->meta_tags = $request->meta_tags;
        $page->template = $request->template;

        if($request->file('image')){
            $uploaded_file = MediaRepo::upload($request->file('image'));
            $page->image = $uploaded_file['full_file_name'];
            $page->media_id = $uploaded_file['media_id'];
        }

        $page->save();

        return redirect()->back()->with('success-alert', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->back()->with('success-alert', 'Page deleted successfully.');
    }

    public function removeImage(Page $page){
        $page->image = null;
        $page->media_id = null;
        $page->save();

        return redirect()->back()->with('success-alert', 'Page images deleted successfully.');
    }
}
