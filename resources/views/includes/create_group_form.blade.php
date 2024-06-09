<div class="row visually-hidden" id="add-group-form">
    <form class="col-6 group-store">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title">
            @error('title')
            <div class="form-text">{{$message}}</div>
            @enderror
            <input type="text" class="form-control" name="user_id" value="{{1}}" hidden>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
