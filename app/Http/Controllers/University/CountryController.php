<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogImage;
use App\Models\Country;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = Country::orderBy('id', 'desc');
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $updateUrl = route('update-country',$row->id); // fill if needed
                    $deleteUrl = route('delete-country', $row->id);

                    $actions = '<div class="d-flex align-items-center gap-2">';

                    $actions .= '<a data-url="' . $updateUrl . '"  data-name="' . htmlspecialchars($row->name, ENT_QUOTES) . '" data-status="' . $row->status . '" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">
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

        return view('university.country.country');
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
        ]);

        DB::beginTransaction();

        try {

            $country = new Country();
            $country->name       = $request->name;
            $country->status = $request->status;
            $country->save();

            DB::commit();
            toast('Country created successfully!', 'success');
            return redirect()->route('country');

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
        $country = Country::find($id);

        if (empty($country)){
            abort(404);
        }
        $request->validate([
            'name'       => 'required',
        ]);

        DB::beginTransaction();

        try {

            $country->name       = $request->name;
            $country->status = $request->status;
            $country->save();

            DB::commit();
            toast('Country updated successfully!', 'success');
            return redirect()->route('country');

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
        $country = Country::find($id);

        if (empty($country)){
            abort(404);
        }
        try {

            $country->delete();
            toast('Country deleted successfully!','success');

            return redirect()->route('country');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
