<?php

namespace App\Models;

use App\Repositories\Generate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'status', 'title', 'slug', 'short_description', 'description', 'position', 'featured',
        'meta_title', 'meta_description', 'meta_tags', 'image', 'media_id', 'template',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title', 'id']
            ]
        ];
    }

    // Active
    public function scopeActive($q, $take = null){
        $q->where('status', 1);
        $q->latest('id');
        if($take){
            $q->take($take);
        }
    }

    public function getRouteAttribute(){
        return route('page', $this->slug);
    }

    // Media
    public function Media(){
        return $this->belongsTo(Media::class);
    }

    public function getImgPathsAttribute(){
        if($this->Media){
            return $this->Media->paths;
        }else{
            return [
                'original' => asset('img/no-image.png'),
                'small' => asset('img/no-image.png'),
                'medium' => asset('img/no-image.png'),
                'large' => asset('img/no-image.png')
            ];
        }
    }
}
