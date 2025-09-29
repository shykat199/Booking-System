<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $fillable = [
        'country_id',
        'city_id',
        'name',
        'cricos',
        'campus_count',
        'description',
        'logo',
        'image',
        'status',
    ];
}
