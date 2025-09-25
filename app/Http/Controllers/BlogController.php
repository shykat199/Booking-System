<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogImage;
use App\Models\Task;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = Blog::with('user','images')->where('user_id',auth()->user()->id)->latest();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-blog', $row->slug);
                    $deleteUrl = route('delete-blog', $row->slug);

                    $actions = '<a href="' . $editUrl . '"><i class="fa-regular fa-pen-to-square fa-2x" aria-hidden="true"></i></a>';
                    $actions .= '<i onclick="showSwal(\'passing-parameter-execute-cancel\', \'' . e($deleteUrl) . '\')" class="fa-solid fa-trash fa-2x text-danger ms-2" aria-hidden="true"></i>';

                    return $actions;
                })

                ->addColumn('description', function ($row) {
                    return \Illuminate\Support\Str::limit(strip_tags($row->description), 70, '...');
                })
                ->addColumn('images', function ($row) {
                    $html = '<div class="row g-1">';
                    foreach ($row->images as $img) {
                        $html .= '<div class="col-6">';
                        $html .= '<img src="' . asset('storage/' . $img->image) . '" class="img-thumbnail blog-thumb" style="width:100%; height:100px; object-fit:cover; cursor:pointer;" data-bs-toggle="modal" data-bs-target="#imageModal" data-src="' . asset('storage/' . $img->image) . '">';
                        $html .= '</div>';
                    }
                    $html .= '</div>';
                    return $html;
                })
                ->rawColumns(['action','description','images'])
                ->make(true);
        }

        return view('blog.index');
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
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image.*'     => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'author'      => 'required|exists:users,id',
            'published_date' => 'required|date',
        ]);

        DB::beginTransaction();

        try {
            $publishedDate = $request->input('published_date') ?? now();
            $publishedDate = str_replace('T', ' ', $publishedDate);
            if (strlen($publishedDate) == 16) {
                $publishedDate .= ':00';
            }

            $blog = new Blog();
            $blog->title       = $request->title;
            $blog->description = $request->description;
            $blog->user_id     = $request->author;
            $blog->created_at  = $publishedDate;
            $blog->save();

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $file) {
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension    = $file->getClientOriginalExtension();
                    $filename     = $originalName . '_' . time() . '.' . $extension;

                    $path = $file->storeAs('images/blog', $filename, 'public');

                    $blog->images()->create([
                        'image' => $path
                    ]);
                }
            }

            DB::commit();
            toast('Blog created successfully!', 'success');
            return redirect()->route('blog');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        if (empty($blog)){
            abort(404);
        }
        $data['authors']=User::all();
        $data['blog']=$blog;
        $data['blog_images']=$blog->images;
        return view('blog.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        if (empty($blog)){
            abort(404);
        }
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image.*'     => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'author'      => 'required|exists:users,id',
            'published_date' => 'required|date',
        ]);

        DB::beginTransaction();

        try {

            $publishedDate = $request->input('published_date') ?? now();
            $publishedDate = str_replace('T', ' ', $publishedDate);
            if (strlen($publishedDate) == 16) {
                $publishedDate .= ':00';
            }

            $blog->title       = $request->title;
            $blog->description = $request->description;
            $blog->user_id     = $request->author;
            $blog->created_at  = $publishedDate;
            $blog->save();

            if ($request->hasFile('image')) {
                foreach ($blog->images as $oldImage) {
                    if (\Storage::disk('public')->exists($oldImage->image)) {
                        \Storage::disk('public')->delete($oldImage->image);
                    }
                    $oldImage->delete();
                }

                foreach ($request->file('image') as $file) {
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension    = $file->getClientOriginalExtension();
                    $filename     = $originalName . '_' . time() . '.' . $extension;
                    $path         = $file->storeAs('images/blog', $filename, 'public');

                    $blog->images()->create([
                        'image' => $path
                    ]);
                }
            }

            DB::commit();
            toast('Blog updated successfully!', 'success');
            return redirect()->route('blog');

        } catch (\Exception $e) {
            DB::rollBack(); // rollback if anything fails
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if (empty($blog)){
            abort(404);
        }
        try {
            foreach ($blog->images as $image) {
                if (\Storage::disk('public')->exists($image->image)) {
                    \Storage::disk('public')->delete($image->image);
                }
                $image->delete();
            }

            $blog->delete();
            toast('Blog deleted successfully!','success');

            return redirect()->route('blog');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function deleteImage(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:blog_images,id',
        ]);

        $image = BlogImage::findOrFail($request->id);

        if (\Storage::disk('public')->exists($image->image)) {
            \Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        return response()->json(['success' => true]);
    }

}
