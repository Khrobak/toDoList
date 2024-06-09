<div class="visually-hidden update-task{{$task->id}}">
    <form enctype="multipart/form-data" id="update-task{{$task->id}}form"
          class="update-task" method="post" action="{{route('tasks.update', $task)}}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title"
                   value="{{$task->title}}">
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
            <img style="max-height: 150px; max-width: 100px" class='col'
                 src="{{asset('storage/'. $task->preview_img)}}" alt="image">
            <div class="col">
                <label for="image" class="form-label">Add or update image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            @error('image')
            <div class="form-text">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="yes" id="flexCheckIndeterminate" name="delete">
                <label class="form-check-label" for="flexCheckIndeterminate">
                    Delete image
                </label>
            </div>
        </div>
        <input type="text" class="form-control" name="group_id" value="{{$task->group_id}}"
               hidden>
        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
</div>
