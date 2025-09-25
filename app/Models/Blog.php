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

    public function firstImage()
    {
        return $this->hasOne(BlogImage::class, 'blog_id')->select('id', 'blog_id', 'image');
    }

    public function postActions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PostAction::class, 'post_id','id');
    }

    public function likes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->postActions()->where('action_status', BLOG_LIKE_STATUS);
    }

    public function unlikes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->postActions()->where('action_status', BLOG_UNLIKE_STATUS);
    }


}
