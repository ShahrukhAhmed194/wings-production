<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FestivalMember extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'festival_id', 'name', 'nick_name', 'image','father_name', 'mother_name', 'email', 'phone_number',
        'session', 'gender', 'blood_group', 'address', 't_shirt', 'organization_name', 'designation',
        'organization_phone', 'organization_address',
        'number_of_person','number_of_guest', 'fee_amount','guest_fee_amount', 'payable_amount', 'payment_type', 'transaction_no', 'is_paid',
    ];

    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }

    /*public function getImageAttribute($image)
    {
        $img = $image ? asset($image):null;
        if (!$img) return $img;
        $urlParts = pathinfo($img);
        $extension = $urlParts['extension'];

        $base64 = 'data:image/' . $extension . ';base64,' . base64_encode(\Illuminate\Support\Facades\Http::get($img)->body());
        return $base64;
    }*/
}
