@extends('layouts.app')
@section('content')
<div>
    <form class="col-6" action="{{route('tasks.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
            @error('title')
            <div class="form-text">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <input type="text" class="form-control" id="tags" name="tags" value="{{old('tags')}}">
            @error('tags')
            <div class="form-text">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" >
            @error('image')
            <div class="form-text">{{$message}}</div>
            @enderror
        </div>
        <input type="text" class="form-control" name="task_list_id" value="{{$group->id}}" hidden>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
