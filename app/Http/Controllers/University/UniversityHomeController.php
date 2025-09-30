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
        $data['universities'] = University::with(['country','city'])->where('status',ACTIVE_STATUS)->latest()->limit(15)->get();
        $data['total'] = University::where('status',ACTIVE_STATUS)->count();
        $data['countries'] = Country::where('status',ACTIVE_STATUS)->get();
        return view('university.home',$data);

    }

    public function filter(Request $request)
    {
        $countryIds = $request->input('countries', []); // array of selected country IDs
        $offset = $request->input('offset', 0);
        $limit = 10;

        $query = University::orderBy('id', 'asc');

        if (!empty($countryIds)) {
            $query->whereIn('country_id', $countryIds);
        }

        $universities = $query->skip($offset)->take($limit)->get();

        $html = '';
        foreach ($universities as $university) {
            $html .= view('university.partials.university_cards', compact('university'))->render();
        }

        return response()->json([
            'html' => $html,
        ]);
    }

    public function loadMore(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = 10;

        $universities = University::with(['country','city'])->latest()
            ->skip($offset)
            ->take($limit)
            ->get();

        $html = '';
        foreach ($universities as $university) {
            $html .= view('university.partials.university_cards', compact('university'))->render();
        }

        $allLoaded = ($offset + $limit) >= University::count();

        return response()->json([
            'html' => $html,
            'allLoaded' => $allLoaded,
        ]);
    }
}
