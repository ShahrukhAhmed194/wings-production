<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKid extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id', 'name', 'dob',
    ];

    public function getBirthDayAttribute(){
        return date('d', strtotime($this->dob));
    }

    public function getBirthMonthAttribute(){
        return (int)date('m', strtotime($this->dob));
    }

    public function getBirthYearAttribute(){
        return date('Y', strtotime($this->dob));
    }
}
