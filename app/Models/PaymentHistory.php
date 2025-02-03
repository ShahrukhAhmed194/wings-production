<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id', 'status', 'amount', 'trx_id','nagad_tnx_id', 'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
