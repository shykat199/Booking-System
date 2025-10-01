<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\ContactUs;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ContactUsController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = ContactUs::orderBy('id', 'desc');
            return DataTables::of($data)
                ->make(true);
        }

        return view('university.contact-us.contact-us');
    }

    public function sendQuery(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'required|string|max:20',
            'query'     => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        ContactUs::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'query' => $request->input('query'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your query has been sent successfully!'
        ]);
    }
}
