<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=[
        'status', 'name', 'position', 'category_id',
    ];
    // Active
    public function scopeActive($q, $take = null){
        $q->where('status', 1);
        $q->latest('id');
        if($take){
            $q->take($take);
        }
    }
    public function GalleryItems(){
        return $this->hasMany(GalleryItem::class)->orderBy('position');
    }

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function getImgPathAttribute()
    {
        return $this->GalleryItems[0]->img_paths['small'] ?? asset('img/no-image.png');
    }
}
