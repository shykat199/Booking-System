<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyArea extends Model
{
    protected $fillable = ['program_id','name','status','university_id'];

    public function program()
    {
        return $this->belongsTo(Programs::class,'program_id','id');
    }
}
