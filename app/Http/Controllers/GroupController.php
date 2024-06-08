<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use App\Models\Tag;

use App\Models\Task;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request = null): View
    {

        $listCollection = Group::query()
            ->select(['title', 'user_id', 'id', 'created_at'])
            ->with('tasks.tags')
            ->orderByDesc('created_at')
            ->get();

        $tagList = $listCollection->map(function ($group) {
            return $group->tasks->map(function ($item) {
                return $item->tags;
            })->flatten();
        })->flatten()->unique('title')->all();

        $groups = GroupResource::collection($listCollection);
        return view('groups.index', compact('groups', 'tagList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroupRequest $request): JsonResponse
    {
        Group::create($request->validated());
        return response()->json([
            'isSuccessful' => true,
            'message' => 'List stored successfully',
        ]);
    }


    public function update(UpdateGroupRequest $request)
    {
        $data = $request->validated();

        $record = Group::findOrFail($data['id']);

        $record->update($data);

        return response()->json([
            'isSuccessful' => true,
            'message' => 'Data updated successfully'
        ]);
//        return redirect()->route('groups.index')->with('status', 'List updated!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $list): RedirectResponse
    {
        $list->delete();
        return redirect()->route('groups.index')->with('status', 'List deleted!');
    }

    public function filter(Request $request): View
    {

        $tags = Tag::whereIn('tags.id', $request->get('tags'))
            ->join('tag_task', 'tags.id', '=', 'tag_task.tag_id')
            ->select('tag_id', 'task_id')
            ->groupBy('task_id', 'tag_id');
        $tasks = Task::joinSub($tags, 'tags', function (JoinClause $join) {
            $join->on('tasks.id', '=', 'tags.task_id');
        });
        $groups = Group::whereIn('id', $tasks->select('group_id')->getQuery())->get();
        $tagList = $groups->map(function ($group) {
            return $group->tasks->map(function ($item) {
                return $item->tags;
            })->flatten();
        })->flatten()->unique('title')->all();

        $groups = GroupResource::collection($groups);
        return view('groups.index', compact('groups'));
    }
}
