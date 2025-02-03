<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_id', 'member_id_string', 'type','member_type_id', 'status', 'payment_status', 'first_name', 'last_name',
        'bengali_name', 'nick_name', 'email', 'username', 'mobile_number', 'dob', 'place_of_birth',
        'facebook_link', 'father_name', 'marital_status', 'spouse_name', 'spouse_dob', 'gender',
        'blood_group', 'profile_image','academic_session', 'department', 'hall', 'mailing_address', 'mailing_city',
        'mailing_district', 'mailing_post_code', 'mailing_country', 'contact_no_res', 'permanent_address',
        'permanent_city', 'permanent_district', 'permanent_post_code', 'permanent_country', 'organization',
        'organization_designation', 'organization_phone','n_id','mother_name',
        'organization_address', 'address', 'password', 'payment_method', 'payment_trx_number', 'update_note',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Active
    public function scopeActive($q, $order = 'id', $type = null, $take = null){
        $q->where('status', 'approved');
        $q->where('payment_status', 'paid');
        if($type){
            $q->where('type', $type);
        }
        $q->latest($order);
        if($take){
            $q->take($take);
        }
        return $q;
    }

    // Profile paths
    public function getProfilePathAttribute(){
        if($this->profile_image && file_exists(public_path('uploads/user/' . $this->profile_image))){
            return asset('uploads/user/' . $this->profile_image);
        }

        return asset('img/user-img.jpg');
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getMailingAddressStringAttribute()
    {
        return $this->mailing_address . ', ' . $this->mailing_city . ', ' . $this->mailing_district . ', ' . $this->mailing_post_code . ', ' . $this->mailing_country;
    }

    public function getPermanentAddressStringAttribute()
    {
        return $this->permanent_address . ', ' . $this->permanent_city . ', ' . $this->permanent_district . ', ' . $this->permanent_post_code . ', ' . $this->permanent_country;
    }

    public function UserKids(){
        return $this->hasMany(UserKid::class);
    }

    public function getBirthDayAttribute(){
        if($this->dob){
            return date('d', strtotime($this->dob));
        }
        return null;
    }

    public function getBirthMonthAttribute(){
        if($this->dob){
            return (int)date('m', strtotime($this->dob));
        }
        return null;
    }

    public function getBirthYearAttribute(){
        if($this->dob){
            return date('Y', strtotime($this->dob));
        }
        return null;
    }

    public function getSpouseBirthDayAttribute(){
        if($this->spouse_dob){
            return date('d', strtotime($this->spouse_dob));
        }
        return null;
    }

    public function getSpouseBirthMonthAttribute(){
        if($this->spouse_dob){
            return (int)date('m', strtotime($this->spouse_dob));
        }
        return null;
    }

    public function getSpouseBirthYearAttribute(){
        if($this->spouse_dob){
            return date('Y', strtotime($this->spouse_dob));
        }
        return null;
    }

    public function memberType()
    {
        return $this->belongsTo(MemberType::class);
    }
}
