<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Programs;
use App\Models\StudyArea;
use App\Models\University;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Storage;
use Yajra\DataTables\Facades\DataTables;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = University::with(['country','city'])->orderBy('id', 'desc');
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-university',$row->id);
                    $deleteUrl = route('delete-university', $row->id);

                    $actions = '<div class="d-flex align-items-center gap-2">';

                    $actions .= '<a href="'.$editUrl.'">
                                    <i class="fa-regular fa-pen-to-square fa-2x text-warning" aria-hidden="true"></i>
                                </a>';

                    $actions .= '<a href="javascript:void(0);" onclick="showSwal(\'passing-parameter-execute-cancel\', \'' . e($deleteUrl) . '\')">';
                    $actions .= '<i class="fa-solid fa-trash fa-2x text-danger" aria-hidden="true"></i>';
                    $actions .= '</a>';

                    $actions .= '</div>';

                    return $actions;
                })
                ->addColumn('logo', function ($row) {
                    if ($row->logo) {
                        return '<img src="' . asset('storage/' . $row->logo) . '"
                        alt="Logo"
                        style="width:50px; height:50px; object-fit:cover; border-radius:5px;">';
                    }
                    return '<span class="badge bg-secondary">No Logo</span>';
                })
                ->rawColumns(['action','logo'])
                ->make(true);
        }


        return view('university.university.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['countries']=Country::where('status', ACTIVE_STATUS)->orderBy('name','ASC')->get();
        $data['university'] = null;
        $data['programs'] = Programs::where('status', ACTIVE_STATUS)->orderBy('name','ASC')->get();
        return view('university.university.form',$data);
    }
    public function edit($id)
    {
        $university = University::with(['country','city'])->findOrFail($id);
        $data['countries']=Country::where('status', ACTIVE_STATUS)->orderBy('name','ASC')->get();
        $data['university'] = $university;
        $data['cities'] = City::where('country_id',$university->country->id)->orderBy('name','ASC')->get();
        $data['programs'] = Programs::where('status', ACTIVE_STATUS)->orderBy('name','ASC')->get();
        $data['studyAreas'] = StudyArea::with('program')->select(
            'program_id',
            DB::raw('GROUP_CONCAT(name SEPARATOR "<||>") as courses')
        )
            ->where('university_id', $university->id)
            ->groupBy('program_id')
            ->get();

        return view('university.university.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        DB::beginTransaction();

        try {

            $request->validate([
                'country_id'   => 'required|integer|exists:countries,id',
                'city_id'      => 'required|integer|exists:cities,id',
                'name'         => 'required|string|max:255',
                'cricos'       => 'nullable|string|max:255',
                'campus_count' => 'nullable|integer|min:0',
                'description'  => 'nullable|string',
                'logo'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
                'status'       => 'required|in:0,1',
                'groups' => 'required|array',
                'groups.*.select' => 'required|array',
                'groups.*.input' => 'required|array',
            ]);

            $logoPath = null;
            $imagePath = null;

            if ($request->hasFile('logo')) {
                $logo      = $request->file('logo');
                $logoName  = pathinfo($logo->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $logo->getClientOriginalExtension();
                $fileName  = $logoName . '_' . time() . '.' . $extension;

                $logoPath = $logo->storeAs('universities/logos', $fileName, 'public');
            }

            if ($request->hasFile('image')) {
                $image     = $request->file('image');
                $imageName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileName  = $imageName . '_' . time() . '.' . $extension;

                $imagePath = $image->storeAs('universities/images', $fileName, 'public');
            }

            $university = new University();
            $university->country_id   = $request->country_id;
            $university->city_id      = $request->city_id;
            $university->name         = $request->name;
            $university->cricos       = $request->cricos;
            $university->campus_count = $request->campus_count;
            $university->description  = $request->description;
            $university->logo         = $logoPath;
            $university->image        = $imagePath;
            $university->status       = $request->status;
            $university->save();

            foreach ($request->groups as $group) {
                $programs = $group['select'] ?? [];
                $courseItems = $group['input'] ?? [];

                foreach ($programs as $programId) {
                    foreach ($courseItems as $courseName) {
                        if ($programId && $courseName) {
                            StudyArea::create([
                                'university_id' => $university->id,
                                'program_id' => $programId,
                                'name' => $courseName,
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            toast('University created successfully!', 'success');
            return redirect()->route('university');

        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Something went wrong: '.$e->getMessage())
                ->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'country_id'   => 'required|integer|exists:countries,id',
            'city_id'      => 'required|integer|exists:cities,id',
            'name'         => 'required|string|max:255',
            'cricos'       => 'nullable|string|max:255',
            'campus_count' => 'nullable|integer|min:0',
            'description'  => 'nullable|string',
            'logo'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status'       => 'required|in:0,1',
            'groups' => 'required|array',
            'groups.*.select' => 'required|array',
            'groups.*.input' => 'required|array',
        ]);

        DB::beginTransaction();

        try {
            $university = University::findOrFail($id);

            if ($request->hasFile('logo')) {
                if ($university->logo && Storage::disk('public')->exists($university->logo)) {
                    Storage::disk('public')->delete($university->logo);
                }

                $logo      = $request->file('logo');
                $logoName  = pathinfo($logo->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $logo->getClientOriginalExtension();
                $fileName  = $logoName . '_' . time() . '.' . $extension;

                $logoPath = $logo->storeAs('universities/logos', $fileName, 'public');
                $university->logo = $logoPath;
            }

            if ($request->hasFile('image')) {
                if ($university->image && Storage::disk('public')->exists($university->image)) {
                    Storage::disk('public')->delete($university->image);
                }

                $image     = $request->file('image');
                $imageName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileName  = $imageName . '_' . time() . '.' . $extension;

                $imagePath = $image->storeAs('universities/images', $fileName, 'public');
                $university->image = $imagePath;
            }

            $university->country_id   = $request->country_id;
            $university->city_id      = $request->city_id;
            $university->name         = $request->name;
            $university->cricos       = $request->cricos;
            $university->campus_count = $request->campus_count;
            $university->description  = $request->description;
            $university->status       = $request->status;
            $university->save();

            StudyArea::where('university_id', $university->id)->delete();

            foreach ($request->groups as $group) {
                $programs = $group['select'] ?? [];
                $courseItems = $group['input'] ?? [];

                foreach ($programs as $programId) {
                    foreach ($courseItems as $courseName) {
                        if ($programId && $courseName) {
                            StudyArea::create([
                                'university_id' => $university->id,
                                'program_id' => $programId,
                                'name' => $courseName,
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            toast('University updated successfully!', 'success');
            return redirect()->route('university');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Something went wrong: '.$e->getMessage())
                ->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $university = University::findOrFail($id);

            if ($university->logo && Storage::disk('public')->exists($university->logo)) {
                Storage::disk('public')->delete($university->logo);
            }

            if ($university->image && Storage::disk('public')->exists($university->image)) {
                Storage::disk('public')->delete($university->image);
            }

            StudyArea::where('university_id', $university->id)->delete();

            $university->delete();

            DB::commit();

            toast('University deleted successfully!', 'success');
            return redirect()->route('university');

        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('University deletion failed: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function getCities($country_id)
    {
        $cities = City::where('country_id', $country_id)->get();

        return response()->json($cities);
    }

}
