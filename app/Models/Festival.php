<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Festival extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'main_title', 'title', 'image', 'description', 'festival_date', 'fee_amount',
        'guest_fee_amount','registration_last_date', 'contact', 'status',
    ];

    public function festivalMembers()
    {
        return $this->hasMany(FestivalMember::class);
    }
    // Active
    public function scopeActive($q, $take = null){
        $q->where('status', 1);
        $q->latest('id');
        if($take){
            $q->take($take);
        }
    }
}
