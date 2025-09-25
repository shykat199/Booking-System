<?php

function active_class($path, $active = 'active') {
    return request()->is(...(array)$path) ? $active : '';
}

function is_active_route($path) {
    return request()->is(...(array)$path) ? 'true' : 'false';
}

function show_class($path) {
    return request()->is(...(array)$path) ? 'show' : '';
}

function generateOtpCode($length = 6): int
{
    $min = pow(10, $length - 1);
    $max = pow(10, $length) - 1;

    return random_int($min, $max);
}

function formatDate($date, string $format = 'd-M-Y H:i:s'): string
{
    return \Illuminate\Support\Carbon::parse($date)->format($format);
}

function getBlogImage($imagePath)
{

    $imageUrl = 'https://images.unsplash.com/photo-1555949963-aa79dcee981c?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=200';

    if ($imagePath && file_exists(storage_path('app/public/' . $imagePath))) {
        $imageUrl = asset('storage/' . $imagePath);
    }

    return $imageUrl;
}

function recentPosts($limit = 5)
{
    return \App\Models\Blog::latest()->limit($limit)->get();
}
