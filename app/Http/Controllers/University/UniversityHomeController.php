<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Programs;
use App\Models\University;
use Illuminate\Http\Request;
use Meilisearch\Client;

class UniversityHomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('q');
        $country = $request->get('country');

        if ($search || $country) {
            $client = new \Meilisearch\Client(config('scout.meilisearch.host'), config('scout.meilisearch.key'));
            $index = $client->index('universities');

            $index->updateFilterableAttributes(['country']);

            $searchOption = [
                'limit' => 15,
                'highlightPreTag' => '<mark>',
                'highlightPostTag' => '</mark>',
                'attributesToHighlight' => ['name','country','city','studyAreas'],
            ];

            if ($country) {
                $searchOption['filter'] = "country = '{$country}'";
            }

            $searchQuery = $search ?? '';
            $results = $index->search($searchQuery, $searchOption);
            $resultsArray = $results->toArray();

            $data['universities'] = $resultsArray['hits'];
            $data['total'] = $resultsArray['estimatedTotalHits'];
            $data['countries'] = Country::where('status', ACTIVE_STATUS)->get();

            return view('university.home-search', $data);
        }

        $data['universities'] = University::with(['country','city'])
            ->where('status', ACTIVE_STATUS)
            ->latest()
            ->limit(15)
            ->get();

        $data['total'] = University::where('status', ACTIVE_STATUS)->count();
        $data['countries'] = Country::where('status', ACTIVE_STATUS)->get();

        return view('university.home', $data);
    }

    public function configureIndex()
    {
        $client = new Client(config('scout.meilisearch.host'), config('scout.meilisearch.key'));
        $index = $client->index('universities');

        $index->updateSettings([
            'typoTolerance' => [
                'enabled' => true,
                'minWordSizeForTypos' => [
                    'oneTypo' => 4,
                    'twoTypos' => 8,
                ],
                'disableOnWords' => [],
                'disableOnAttributes' => [],
            ]
        ]);

        return 'Typo tolerance enabled for universities index';
    }

    public function filter(Request $request)
    {
        $countryIds = $request->input('countries', []);
        $selectedSort = $request->input('sort'); // get sorting option from request

        $query = University::query();

        if (!empty($countryIds)) {
            $query->whereIn('country_id', $countryIds);
        }

        switch ($selectedSort) {
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'country_asc':
                $query->with('country')
                    ->orderBy(
                        Country::select('name')
                            ->whereColumn('countries.id', 'universities.country_id'),
                        'asc'
                    );
                break;

            case 'country_desc':
                $query->with('country')
                    ->orderBy(
                        Country::select('name')
                            ->whereColumn('countries.id', 'universities.country_id'),
                        'desc'
                    );
                break;

            default:
                $query->orderBy('id', 'asc'); // fallback
                break;
        }

        $universities = $query->get();

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

    public function showUniversityDetails($id)
    {
        $university = University::with(['country','city', 'studyAreas.program'])->withCount('studyAreas')->findOrFail($id);
        $universityProgramIds = $university->studyAreas->unique('program_id')->pluck('program_id')->toArray();
        $universityPrograms = Programs::with(['studyAreas'=>function ($query) use ($university) {
            $query->where('university_id', $university->id);
        }])->withCount(['studyAreas'=>function ($q) use ($university) {
            $q->where('university_id', $university->id);
        }])->whereIn('id', $universityProgramIds)->get();

        return view('partials.university-modal', [
            'university' => $university,
            'universityPrograms'=>$universityPrograms,
            'availableProgramCount'=> !empty($universityProgramIds) ? count($universityProgramIds) : 0,
        ]);
    }
}
