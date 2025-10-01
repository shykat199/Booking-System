<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\University;
use Illuminate\Http\Request;
use Meilisearch\Client;

class UniversityHomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('q');

        if ($search) {
            $client = new \Meilisearch\Client(config('scout.meilisearch.host'), config('scout.meilisearch.key'));
            $index = $client->index('universities');

            $results = $index->search($search, [
                'limit' => 15,
                'highlightPreTag' => '<mark>',
                'highlightPostTag' => '</mark>',
                'attributesToHighlight' => ['name','country','city','studyAreas'],
            ]);

            $resultsArray = $results->toArray();

            $data['universities'] = $resultsArray['hits'];
            $data['total'] = $resultsArray['estimatedTotalHits'];

            $data['countries'] = Country::where('status', ACTIVE_STATUS)->get();

            return view('university.home-search', $data);
        } else {
            $data['universities'] = University::with(['country','city'])

                ->where('status', ACTIVE_STATUS)
                ->latest()
                ->limit(15)
                ->get();
            $data['total'] = University::where('status', ACTIVE_STATUS)->count();

            $data['countries'] = Country::where('status', ACTIVE_STATUS)->get();

            return view('university.home', $data);
        }
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

        $query = University::orderBy('id', 'asc');

        if (!empty($countryIds)) {
            $query->whereIn('country_id', $countryIds);
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
}
