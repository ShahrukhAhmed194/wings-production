<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalleryItem extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=[
        'gallery_id', 'image', 'position',
    ];

    public function getImgPathsAttribute(){
        $file_name = $this->image;
        $output = array();

        if(file_exists(public_path("uploads/gallery/small/$file_name"))){
            $output['small'] = asset("uploads/gallery/small/$file_name");
        }else{
            $output['small'] = asset('img/no-image.png');
        }

        if(file_exists(public_path("uploads/gallery/medium/$file_name"))){
            $output['small'] = asset("uploads/gallery/medium/$file_name");
        }else{
            $output['small'] = asset('img/no-image.png');
        }
        if(file_exists(public_path("uploads/gallery/large/$file_name"))){
            $output['small'] = asset("uploads/gallery/large/$file_name");
        }else{
            $output['small'] = asset('img/no-image.png');
        }
        if(file_exists(public_path("uploads/gallery/$file_name"))){
            $output['original'] = asset("uploads/gallery/$file_name");
        }else{
            $output['original'] = asset('img/no-image.png');
        }

        return $output;
    }
}
