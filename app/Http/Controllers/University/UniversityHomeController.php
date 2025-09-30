<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\University;
use Illuminate\Http\Request;

class UniversityHomeController extends Controller
{
    public function index()
    {
        $data['universities'] = University::with(['country','city'])->where('status',ACTIVE_STATUS)->latest()->get();
        $data['countries'] = Country::where('status',ACTIVE_STATUS)->get();
        return view('university.home',$data);

    }
}
