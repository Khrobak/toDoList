<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use App\Models\Group;
use App\Services\TaskService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class TaskController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(Group $group): View
    {
        return view('tasks.create', compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request, TaskService $service)
    {
        $data = $request->validated();
        $service->store($data);
        return response()->json([
            'isSuccessful' => true,
            'message' => 'Data updated successfully',
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTaskRequest $request, TaskService $service, Task $task)
    {
        $data = $request->validated();
        $status = $service->update($data, $task);
        if ($status) {
            return redirect()->route('groups.index')->with('status', 'Task updated!');
        }
        return back()->withErrors(['msg' => 'An error occurred during the update']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('groups.index')->with('status', 'Task deleted!');
    }
}
