<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'status', 'user_id', 'image'];

    protected static function booted(): void
    {
        static::creating(function ($blog) {
            $slug = Str::slug($blog->title);
            $count = self::where('slug', 'like', "$slug%")->count();
            $blog->slug = $count ? $slug . '-' . ($count + 1) : $slug;
        });
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BlogImage::class,'blog_id','id');
    }
}
