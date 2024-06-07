<?php

namespace App\Services;

use App\Models\Tag;
use App\Models\Task;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class TaskService
{
    public function store(array $data): void
    {
        //store images
        if (isset($data['image'])) {
            $file = $data['image'];
            $this->storeImages($file, $data);
        }

        //create tags
        $tags = $this->addDataToTagModel($data);

        unset($data['tags'], $data['image']);

        //create task
        $task = Task::create($data);
        $task->tags()->attach(Tag::whereIn('title', $tags)->get());
    }

    public function update(array $data, Task $task): bool
    {
        //update images
        if (!empty($data['image']) && $data['image']->getClientOriginalName() !== Str::replace('images/', '', $task->main_img)) {
            $file = $data['image'];
            $this->storeImages($file, $data);
        }

        //upsert tags
          $tags = $this->addDataToTagModel($data);

        unset($data['tags'], $data['image']);

        //update task
        $status = $task->update($data);
        if ($status) {
            $task->tags()->sync(Tag::whereIn('title', $tags)->get());
            return $status;
        } else {
            return false;
        }
    }

    public function storeImages(UploadedFile $file, array &$data): void
    {
        $fileName = $file->getClientOriginalName();
        $path = Storage::disk('public')->putFileAs('images', $file, $fileName);
        $manager = new ImageManager(new Driver());
        $manager
            ->read($file->getRealPath())
            ->scale(150, 150)
            ->save(Storage::disk('public')->path('images/' . 'preview_' . $fileName));
        $data['preview_img'] = 'images/' . 'preview_' . $fileName;
        $data['main_img'] = $path;
    }

    public function addDataToTagModel(array &$data): Collection
    {
        $tags = collect($data['tags']);
        $map_tags = $tags->map(function ($tag) {
            return ['title' => $tag];
        });
        Tag::upsert($map_tags->toArray(), 'title');
        return $tags;
    }

}

