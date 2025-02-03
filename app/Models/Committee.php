<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Committee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'status', 'name', 'short_description',
    ];

    public function CommitteeMembers(){
        return $this->hasMany(CommitteeMember::class)->active();
    }

    // Active
    public function scopeActive($q, $order = 'id', $take = null){
        $q->where('status', 1);
        $q->latest($order);
        if($take){
            $q->take($take);
        }
    }
}
