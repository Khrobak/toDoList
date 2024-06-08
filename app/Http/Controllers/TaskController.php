<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Services\TaskService;
use App\Models\Task;
use App\Models\Group;
use Illuminate\Http\RedirectResponse;
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
    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $data = $request->validated();
        app(TaskService::class)->store($data);
        return redirect()->route('groups.index')->with('status', 'Task updated!');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTaskRequest $request, Task $task)
    {
        $data = $request->validated();
        $status = app(TaskService::class)->update($data, $task);
        if ($status) {
            return redirect()->route('groups.index')->with('status', 'Task updated!');
        }
        return back()->withErrors(['msg' => 'An error occurred during the update']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task):RedirectResponse
    {
        $task->delete();
        return redirect()->route('groups.index')->with('status', 'Task deleted!');
    }
}
