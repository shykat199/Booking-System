<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class University extends Model
{
    use Searchable;

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

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'logo' => $this->logo ?? null,
            'image' => $this->image ?? null,
            'cricos' => $this->cricos,
            'country' => $this->country?->name,
            'city' => $this->city?->name,
            'studyAreas' => $this->studyAreas->pluck('name')->toArray(),
        ];
    }

}
