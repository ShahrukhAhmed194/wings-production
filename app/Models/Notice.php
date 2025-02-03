<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notice extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[ 'status', 'title', 'description', 'send_mail_to',];

    // Active
    public function scopeActive($q, $take = null){
        $q->where('status', 1);
        $q->latest('id');
        if($take){
            $q->take($take);
        }
    }
}
