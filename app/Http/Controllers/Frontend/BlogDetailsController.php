<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogDetailsController extends Controller
{
    public function index($slug)
    {
        return view('frontend.blog-details');
    }
}
