<?php
namespace App\Traits;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait FileUploadTrait{

    /*
     * method for image upload
     * */
    protected function imageUpload($image,$path, $width=null, $height=null): string
    {
        if (!Storage::disk('public')->exists($path)){
            Storage::disk('public')->makeDirectory($path);
        }
        $imgName = date('Y').uniqid().'.'.$image->getClientOriginalExtension();
        $img = Image::make($image)->resize($width,$height)->stream();
        //$webp = Image::make('public/foo.png')->encode('webp', 75);
        Storage::disk('public')->put($path.'/'.$imgName,$img);
        return '/storage/'.$path.'/'.$imgName;
    }

    /*
     * method for remove file
     * */
    protected function removeImage($path){
        if(file_exists(public_path($path))){
            unlink(public_path($path));
        }
    }

    /*
     * method for remove file
     * */
    protected function removeFile($path){
        if(file_exists(public_path($path))){
            unlink(public_path($path));
        }
    }

    /*
     * method for file upload
     * */
    protected function uploadFile($file,$path): string
    {
        if (!Storage::disk('public')->exists($path)){
            Storage::disk('public')->makeDirectory($path);
        }
        $file_name= date('Y').uniqid().'.'.$file->getClientOriginalExtension();
        $location='/storage/'.$path.'/'.date('Y');
        $file->move(public_path($location),$file_name);
        return $location.'/'.$file_name;
    }
}
