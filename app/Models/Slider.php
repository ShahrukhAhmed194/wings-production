<?php

namespace App\Models;

use App\Repositories\MediaRepo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'status', 'position', 'text_1', 'text_2', 'text_3', 'button_1_text', 'button_1_url', 'button_2_text',
        'button_2_url', 'short_description', 'description', 'image', 'image_path', 'media_id',
    ];

    // Active
    public function scopeActive($q, $take = null){
        $q->where('status', 1);
        $q->orderBy('position');
        if($take){
            $q->take($take);
        }
    }

    // Image Paths
    public function getImgPathsAttribute(){
        return MediaRepo::sizes($this->image_path, $this->image);
    }
}
