<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = City::with('country')->orderBy('id', 'desc');
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $updateUrl = route('update-city',$row->id); // fill if needed
                    $deleteUrl = route('delete-city', $row->id);

                    $actions = '<div class="d-flex align-items-center gap-2">';

                    $actions .= '<a data-country = "'.$row->country->id.'" data-url="' . $updateUrl . '"  data-name="' . htmlspecialchars($row->name, ENT_QUOTES) . '" data-status="' . $row->status . '" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">
                                    <i class="fa-regular fa-pen-to-square fa-2x text-warning" aria-hidden="true"></i>
                                </a>';

                    $actions .= '<a href="javascript:void(0);" onclick="showSwal(\'passing-parameter-execute-cancel\', \'' . e($deleteUrl) . '\')">';
                    $actions .= '<i class="fa-solid fa-trash fa-2x text-danger" aria-hidden="true"></i>';
                    $actions .= '</a>';

                    $actions .= '</div>';

                    return $actions;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $data['countries'] = Country::where('status', ACTIVE_STATUS)->orderBy('name','ASC')->get();

        return view('university.city.city',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['authors']=User::all();
        $data['blog'] = null;
        return view('blog.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'status' => 'required|string',
            'country_id' => 'required|string',
        ]);

        DB::beginTransaction();

        try {

            $city = new City();
            $city->name       = $request->name;
            $city->country_id       = $request->country_id;
            $city->status = $request->status;
            $city->save();

            DB::commit();
            toast('City created successfully!', 'success');
            return redirect()->route('city');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $city = City::find($id);

        if (empty($city)){
            abort(404);
        }
        $request->validate([
            'name'       => 'required|string|max:255',
            'status' => 'required|string',
            'country_id' => 'required|string',
        ]);

        DB::beginTransaction();

        try {

            $city->name       = $request->name;
            $city->country_id       = $request->country_id;
            $city->status = $request->status;
            $city->save();

            DB::commit();
            toast('City updated successfully!', 'success');
            return redirect()->route('city');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $city = City::find($id);

        if (empty($city)){
            abort(404);
        }
        try {

            $city->delete();
            toast('City deleted successfully!','success');

            return redirect()->route('city');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
