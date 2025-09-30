<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Programs;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProgramsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = Programs::orderBy('id', 'desc');
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $updateUrl = route('update-program',$row->id);
                    $deleteUrl = route('delete-program', $row->id);

                    $actions = '<div class="d-flex align-items-center gap-2">';

                    $actions .= '<a data-url="' . $updateUrl . '" data-duration="' . $row->duration . '"  data-name="' . htmlspecialchars($row->name, ENT_QUOTES) . '" data-status="' . $row->status . '" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">
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


        return view('university.program.program');
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
            'duration' => 'required|string',
        ]);

        DB::beginTransaction();

        try {

            $program = new Programs();
            $program->name       = $request->name;
            $program->duration       = $request->duration;
            $program->status = $request->status;
            $program->save();

            DB::commit();
            toast('Program created successfully!', 'success');
            return redirect()->route('program');

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
        $program = Programs::find($id);

        if (empty($program)){
            abort(404);
        }

        $request->validate([
            'name'       => 'required|string|max:255',
            'status' => 'required|string',
            'duration' => 'required|string',
        ]);

        DB::beginTransaction();

        try {

            $program->name       = $request->name;
            $program->duration       = $request->duration;
            $program->status = $request->status;
            $program->save();

            DB::commit();
            toast('Program updated successfully!', 'success');
            return redirect()->route('program');

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
        $program = Programs::find($id);

        if (empty($program)){
            abort(404);
        }
        try {

            $program->delete();
            toast('Program deleted successfully!','success');

            return redirect()->route('program');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
