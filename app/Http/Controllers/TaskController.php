<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['tasks'] = Task::orderBy('id','DESC')->get();
        return view('task-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'task' => 'required|max:255',
            ]);

            $task = Task::create([
                'title' => $validated['task'],
                'is_completed' => false,
            ]);

            $html = view('partials.task-item', compact('task'))->render();

            return response()->json([
                'success' => true,
                'html' => $html,
                'message' => 'Task saved successfully'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->validator->errors()->first()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Task save error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while saving the task.'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        try {

            $task->is_completed = filter_var($request->completed, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
            $task->save();

            return response()->json([
                'success' => true,
                'message' => $task->is_completed === 1
                    ? 'Task marked as completed!'
                    : 'Task marked as incomplete!',
                'task_id' => $task->id,
                'status' => $task->is_completed,
            ]);

        }catch (\Exception $e) {

            Log::error('Task update error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while updating the task.',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            $task->delete();

            return response()->json([
                'success' => true,
                'message' => 'Task deleted successfully!',
                'task_id' => $task->id
            ]);

        } catch (\Exception $e) {
            \Log::error('Task delete error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while deleting the task.'
            ], 500);
        }
    }
}
