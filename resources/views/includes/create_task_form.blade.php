<li class="visually-hidden list-group-item" id='{{$group->id}}li'>
    <div class="m-1">
        <form class="store-task"
              enctype="multipart/form-data" class="{{$group->id}}" method="post"
              action="{{route('tasks.store')}}">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                       value="{{old('title')}}">
            </div>
            <div class="mb-3">
                <label for="tags" class="form-label">Tags</label>
                <input type="text" class="form-control" id="tags" name="tags"
                       value="{{old('tags')}}">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
                @error('image')
                <div class="form-text">{{$message}}</div>
                @enderror
            </div>
            <input type="text" class="form-control" name="group_id" value="{{$group->id}}" hidden>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</li>
