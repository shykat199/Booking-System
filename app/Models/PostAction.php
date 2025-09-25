<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostAction extends Model
{
    protected $fillable = ['post_id','user_id','action_status'];
}
