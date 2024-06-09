<div class="row px-4 py-1 visually-hidden update-group{{$group->id}}">
    <form class="update-group" id="update-group{{$group->id}}form" method="post"
          action="{{route('groups.update', $group)}}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$group->title}}">
            @error('title')
            <div class="form-text">{{$message}}</div>
            @enderror
            <input type="text" class="form-control" name="user_id" value="{{auth()->user()->id}}"
                   hidden>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
