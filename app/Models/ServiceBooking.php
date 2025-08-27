<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceBooking extends Model
{
    protected $fillable = ['user_id','service_id','booking_date','status'];

    public function service()
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
