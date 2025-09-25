<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            $title = "Lorem ipsum dolor sit amet Sample Blog Post {$i}";

            $blog = Blog::create([
                'title'       => $title,
                'slug'        => Str::slug($title) . '-' . $i,
                'description' => "This is the description for {$title}.",
                'status'      => ACTIVE_STATUS,
                'user_id'     => 1,
            ]);

            for ($j = 1; $j <= 4; $j++) {
                BlogImage::create([
                    'blog_id' => $blog->id,
                    'image'   => "https://picsum.photos/seed/blog-{$i}-img-{$j}/600/400",
                ]);
            }
        }
    }
}
