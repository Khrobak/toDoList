@extends('layouts.app')
@section('content')
<div>
    <form class="col-6" action="{{route('tasks.update', $task)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$task->title}}">
            @error('title')
            <div class="form-text">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <textarea type="text" class="form-control" id="tags" name="tags">
           {{$task->tags->implode('title', ', ')}}
            </textarea>
            @error('tags')
            <div class="form-text">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3 row">
            <img style="max-height: 150px; max-width: 100px" class='col' src="{{asset('storage/'. $task->preview_img)}}" alt="image">
            <div class="col">
                <label for="image" class="form-label">Update image</label>
                <input type="file" class="form-control" id="image" name="image" >
            </div>

            @error('image')
            <div class="form-text">{{$message}}</div>
            @enderror
        </div>
        <input type="text" class="form-control" name="task_list_id" value="{{$task->group_id}}" hidden>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
