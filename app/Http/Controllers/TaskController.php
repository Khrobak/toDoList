<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Services\TaskService;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $data = $request->validated();
        app(TaskService::class)->store($data);
        return redirect()->route('groups.index')->with('status', 'Task stored!');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
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
