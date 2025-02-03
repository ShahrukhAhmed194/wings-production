<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\GalleryItem;
use App\Models\SecondGalleryCategory;
use App\Models\SecondGalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Info;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;


class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::latest('id')->get();
        $categories = Category::where('for', 'gallery')->active()->get();

        return view('back.galleries.index', compact('galleries', 'categories'));
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
        $request->validate([
            'name' => 'required|max:255',
            'position' => 'required'
        ]);

        $gallery = new Gallery;
        $gallery->name = $request->name;
        $gallery->position = $request->position;
        $gallery->category_id = $request->category;
        $gallery->save();
        //cache info forget
        Cache::forget('galleries');
        return redirect()->back()->with('success-alert', 'Gallery created successfully.');
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
    public function edit(Gallery $gallery)
    {
        $categories = Category::where('for', 'gallery')->active()->get();
        return view('back.galleries.edit', compact('gallery', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'name' => 'required|max:255',
            'position' => 'required'
        ]);

        $gallery->name = $request->name;
        $gallery->position = $request->position;
        $gallery->category_id = $request->category;
        $gallery->save();
        //cache info forget
        Cache::forget('galleries');
        return redirect()->back()->with('success-alert', 'Gallery updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        //cache info forget
        Cache::forget('galleries');
        return redirect()->back()->with('success-alert', 'Gallery deleted successfully.');
    }

    public function uploadPhoto(Request $request, $id){
        if (env('RESTRICT_UPLOAD')) return redirect()->back()->with('error-alert', env('RESTRICT_UPLOAD_MESSAGE'));
        $image = $request->file('file');
        $imageName = rand(1111111,999999999).time() . '.webp';

        $sm_h = Info::Settings('media', 'small_height') ?? 150;
        $sm_w = Info::Settings('media', 'small_width') ?? 150;
        $md_h = Info::Settings('media', 'medium_height') ?? 410;
        $md_w = Info::Settings('media', 'medium_width') ?? 410;
        $lg_h = Info::Settings('media', 'large_height') ?? 980;
        $lg_w = Info::Settings('media', 'large_width') ?? 980;

        // sm
        $path = public_path() . '/uploads/gallery/small/';
        File::makeDirectory($path, $mode = 0777, true, true);
        $image_resize = Image::make($image->getRealPath());
        $image_resize->fit($sm_w, $sm_h)->encode("webp");
        $image_resize->save(public_path('/uploads/gallery/small/' . $imageName));
        // md
        $path = public_path() . '/uploads/gallery/medium/';
        File::makeDirectory($path, $mode = 0777, true, true);
        $image_resize = Image::make($image->getRealPath());
        $image_resize->fit($md_w, $md_h)->encode("webp");
        $image_resize->save(public_path('/uploads/gallery/medium/' . $imageName));
        // lg
        $path = public_path() . '/uploads/gallery/large/';
        File::makeDirectory($path, $mode = 0777, true, true);
        $image_resize = Image::make($image->getRealPath());
        $image_resize->fit($lg_w, $lg_h)->encode("webp");
        $image_resize->save(public_path('/uploads/gallery/large/' . $imageName));

        // Original
        $path = public_path() . '/uploads/gallery/';
        File::makeDirectory($path, $mode = 0777, true, true);
        $image_resize = Image::make($image->getRealPath());
        $image_resize->encode("webp");
        $image->move(public_path('/uploads/gallery'), $imageName);

        $gallery_item = new GalleryItem;
        $gallery_item->image = $imageName;
        $gallery_item->gallery_id = $id;
        $gallery_item->save();

        return response()->json(['file_id'=>$gallery_item->id]);
    }

    public function deletePhoto($id){
        $item = GalleryItem::findOrFail($id);
        if(file_exists(public_path("uploads/gallery/small/$item->image"))){
            unlink(public_path("uploads/gallery/small/$item->image"));
        }
        if(file_exists(public_path("uploads/gallery/medium/$item->image"))){
            unlink(public_path("uploads/gallery/medium/$item->image"));
        }
        if(file_exists(public_path("uploads/gallery/large/$item->image"))){
            unlink(public_path("uploads/gallery/large/$item->image"));
        }
        if(file_exists(public_path("uploads/gallery/$item->image"))){
            unlink(public_path("uploads/gallery/$item->image"));
        }
        $item->delete();

        return redirect()->back()->with('success-alert', 'Gallery item deleted successfully.');
    }

    public function changePhotoPosition(Request $request){
        foreach ($request->position as $i => $data) {
            $query = GalleryItem::find($data);
            $query->position = $i;
            $query->save();
        }

        return redirect()->back()->with('success-alert', 'Position updated successfully.');
    }

    public function category(){
        $categories = Category::where('for', 'gallery')->latest('id')->get();

        return view('back.galleries.categories', compact('categories'));
    }

    public function secondGalleryIndex()
    {
        $categories = SecondGalleryCategory::all();

        return view('back.galleries.secondIndex', compact('categories'));
    }

    public function secondGalleryStoreCategory(Request $request)
    {
        $category = new SecondGalleryCategory();
        $category->name = $request->name;
        $category->save();

        return redirect()->back()->with('success-alert', 'Category created successfully.');
    }

    public function secondGalleryDeleteCategory(SecondGalleryCategory $category)
    {
        $category->delete();
        return redirect()->back()->with('success-alert', 'Category deleted successfully.');
    }

    public function secondGalleryEdit($category_id)
    {
        if($category_id){
            $category = $second_gallery_items = [];
            $category = SecondGalleryCategory::find($category_id);
            $second_gallery_items = SecondGalleryItem::where('sec_gallery_category_id', $category_id)->orderby('position')->get();

            return view('back.galleries.secondEdit', compact('category', 'second_gallery_items'));
        }

        return redirect()->back()->with('success-alert', 'Category IdD mismatch.');
    }

    public function secondGalleryUpdateCategory(Request $request, SecondGalleryCategory $category)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $category->name = $request->name;
        $category->save();

        return redirect()->back()->with('success-alert', 'Category Updated successfully.');
    }

    public function secondGalleryuploadPhoto(Request $request)
    {
        $request->validate([
            'image' => 'required|file|image|mimes:jpeg,png,jpg,webp|max:2048',
            'english_title' => 'required|max:255',
            'arabic_title' => 'nullable|max:255',
        ]);        

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $imageName = now()->format('dmY-His') . '-' . uniqid() . '.' .'webp';
            $image = Image::make($file);
            $quality = 90;
            $image->encode('webp', $quality);
            $size_in_kb = strlen($image) / 1024;

            $thumbnailDir = public_path('uploads/second-gallery/thumbnail');
            if (!is_dir($thumbnailDir)) {
                mkdir($thumbnailDir, 0777, true);
            }
            $image->save(public_path('uploads/second-gallery/' . $imageName));
            $thumbnail = $image->resize(150, 150);
            $thumbnailName = 'thumbnail-' . $imageName;
            $thumbnail->save(public_path('uploads/second-gallery/thumbnail/' .$thumbnailName));

            SecondGalleryItem::create([
                'sec_gallery_category_id' => $request->sec_gallery_category_id,
                'position' => $request->position,
                'english_title' => $request->english_title,
                'arabic_title' => $request->arabic_title,
                'image' => $imageName,
                'thumbnail' => $thumbnailName,
                'size_in_kb' => $size_in_kb
            ]);
    
        }

        return redirect()->back()->with('success-alert', 'Photo Added Successfully.');
    }

    public function secondGallerydeletePhoto($id)
    {
        $item = SecondGalleryItem::findOrFail($id);
        $imagePath = public_path('uploads/second-gallery/' . $item->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $item->delete();
        return redirect()->back()->with('success-alert', 'Image deleted successfully.');
    }

    public function secondGallerychangePhotoPosition(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'exists:second_gallery_items,id'
        ]);
        $ids = $request->ids;
        $cases =  $bindings = [];

        foreach ($ids as $index => $id) {
            $cases[] = "WHEN id = ? THEN ?";
            $bindings[] = $id;
            $bindings[] = $index;
        }

        $cases = implode(" ", $cases);

        if (!empty($cases)) {
            DB::update("UPDATE second_gallery_items SET position = CASE $cases END WHERE id IN (" . implode(',', array_fill(0, count($ids), '?')) . ")", array_merge($bindings, $ids));
        }


        return redirect()->back()->with('success-alert', 'Position updated successfully.');
    }

    // public function getSecondGalleryImagesWithCategory()
    // {
    //     $categories = SecondGalleryCategory::all();
    //     $images = SecondGalleryItem::all();

    //     return response()->json([
    //         'categories' => $categories,
    //         'images' => $images->map(function ($item) {
    //             $item->image = asset('uploads/second-gallery/' . $item->image); // Full image URL
    //             return $item;
    //         })
    //     ]);
    // }
}
