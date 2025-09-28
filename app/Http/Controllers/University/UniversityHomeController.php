<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UniversityHomeController extends Controller
{
    public function index()
    {
        return view('university.layouts.app');

    }
}
