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

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id','id');

    }

    public function studyAreas()
    {
        return $this->hasMany(StudyArea::class,'university_id','id');
    }
}
