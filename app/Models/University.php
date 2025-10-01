<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD

class University extends Model
{
=======
use Laravel\Scout\Searchable;

class University extends Model
{
    use Searchable;

>>>>>>> 767dad89759f212545bf68a3618d015122b5327f
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
<<<<<<< HEAD
=======

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'cricos' => $this->cricos,
            'country' => $this->country?->name,
            'city' => $this->city?->name,
            'studyAreas' => $this->studyAreas->pluck('name')->toArray(),
        ];
    }

>>>>>>> 767dad89759f212545bf68a3618d015122b5327f
}
