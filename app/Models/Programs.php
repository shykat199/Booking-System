<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
    protected $fillable = ['duration', 'name', 'status'];

    public function studyAreas()
    {
        return $this->hasMany(StudyArea::class, 'program_id','id');
    }
}
