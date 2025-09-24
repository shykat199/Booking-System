<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendHomeController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function loginPage()
    {
        return view('frontend.auth.login');
    }
}
