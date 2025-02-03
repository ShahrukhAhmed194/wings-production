<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommitteeMember extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'status', 'user_id', 'committee_id', 'designation', 'position', 'description', 'image', 'media_id',
    ];

    // Active
    public function scopeActive($q, $order = 'position', $take = null){
        $q->where('status', 1);
        $q->orderBy($order);
        if($take){
            $q->take($take);
        }
    }

    public function User(){
        return $this->belongsTo(User::class);
    }

    // Media
    public function Media(){
        return $this->belongsTo(Media::class);
    }

    public function getImgPathsAttribute(){
        if($this->Media){
            return $this->Media->paths;
        }elseif($this->User){
            $user_image = $this->User->profile_path;

            return [
                'original' => $user_image,
                'small' => $user_image,
                'medium' => $user_image,
                'large' => $user_image
            ];
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
