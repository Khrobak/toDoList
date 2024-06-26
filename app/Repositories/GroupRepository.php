<?php

namespace App\Repositories;

use App\Http\Resources\GroupResource;
use App\Models\Group as Model;
use App\Models\Tag;
use App\Models\Task;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GroupRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllWithRelations(): ResourceCollection
    {
        $listCollection = $this->startConditions()
            ->query()
            ->select(['title', 'user_id', 'id', 'created_at'])
            ->with('tasks.tags')
            ->orderByDesc('created_at')
            ->get();

        return GroupResource::collection($listCollection);
    }

    public function getAllWithFilterTag(array $data): ResourceCollection
    {

        $tags = Tag::whereIn('tags.id', $data)
            ->join('tag_task', 'tags.id', '=', 'tag_task.tag_id')
            ->select('tag_id', 'task_id')
            ->groupBy('task_id', 'tag_id');
        $tasks = Task::joinSub($tags, 'tags', function (JoinClause $join) {
            $join->on('tasks.id', '=', 'tags.task_id');
        });
        $groups = $this->startConditions()
            ->whereIn('id', $tasks->select('group_id')->getQuery())
            ->get();
        return GroupResource::collection($groups);
    }

    public function getAllWithSearching($data): ResourceCollection
    {
        $tasks = Task::search($data)
            ->get()
            ->map(function ($task) {
                return $task->id;
            })
            ->toArray();
        $listCollection = $this->startConditions()
            ->query()
            ->whereHas('tasks', function ($query) use($tasks) {
                $query->whereIn('id', $tasks);
            })
            ->select(['title', 'user_id', 'id', 'created_at'])
            ->with('tasks.tags')
            ->orderByDesc('created_at')
            ->get();
        return GroupResource::collection($listCollection);
    }
}
