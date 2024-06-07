@extends('layouts.app')

@section('content')
    <div class="row ">
        <div class="col-3"><h1>Your task lists</h1></div>
        <div class="col"><a href="#" class="btn btn-primary" id="add-group"> Add new list </a></div>
        @include('includes.filter_form')
    </div>
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
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="row">
        @foreach($groups as $group)
            <div class=" card col-6 p-1 m-3" id="list{{$group->id}}">
                <div class="row px-4 py-1">
                    <h4 class="col">
                        {{$group->title}}
                    </h4>
                    <a href="#" class="col-2 btn btn-transparent update-group" id="update-group{{$group->id}}">
                        <i class="bi bi-pen"></i> </a>
                    <form class="col-2 destroy-group" id="destroy-group{{$group->id}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$group->id}}">
                        <button type="submit" class="btn btn-transparent"><i class="bi bi-x-square"></i></button>
                    </form>
                </div>
                <div class="row px-4 py-1 visually-hidden update-group{{$group->id}}">
                    <form class="update-group" id="update-group{{$group->id}}form">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$group->title}}">
                            @error('title')
                            <div class="form-text">{{$message}}</div>
                            @enderror
                            <input type="text" class="form-control" name="user_id" value="{{1}}" hidden>
                            <input type="hidden" name="id" value="{{$group->id}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <ul class="list-group">
                    @foreach($group->tasks as $task)
                        <li class="list-group-item">
                            <div class="row">
                                <img style="max-height: 150px; max-width: 100px" class='col'
                                     src="{{asset('storage/'. $task->preview_img)}}" alt="Place for image">
                                <h5 class="col">
                                    {{$task->title}}
                                </h5>
                                <a href="#" class="col-2 btn btn-transparent update-task" id="update-task{{$task->id}}">
                                    <i class="bi bi-pen"></i> </a>
                                <form method="post" action="{{route('tasks.destroy', $task)}}"
                                      class="col-2 destroy-task">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-transparent"><i class="bi bi-x-square"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="visually-hidden update-task{{$task->id}}">
                                <form action="#" enctype="multipart/form-data" id="update-task{{$task->id}}form"
                                      class="update-task">
                                    @csrf
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
                                    <input type="text" class="form-control" name="group_id" value="{{$task->group_id}}"
                                           hidden>
                                    <input type="hidden" name="id" value="{{ $task->id }}">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                            @if(!empty($task->tags->first()))
                                <div>
                                    Tags:
                                    @foreach($task->tags as $tag)
                                        {{$tag->title}}
                                    @endforeach
                                </div>
                            @endif
                        </li>
                    @endforeach
                    <li class="list-group-item">
                        <a id='{{$group->id}}' class="btn btn-outline-dark"
                           href="#"> Add new task</a>
                    </li>
                    <li class="visually-hidden list-group-item" id='{{$group->id}}li'>
                        <div class="m-1">
                            <form class="store-task"
                                  enctype="multipart/form-data" class="{{$group->id}}">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                           value="{{old('title')}}">
                                    @error('title')
                                    <div class="form-text">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tags" class="form-label">Tags</label>
                                    <input type="text" class="form-control" id="tags" name="tags"
                                           value="{{old('tags')}}">
                                    @error('tags')
                                    <div class="form-text">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    @error('image')
                                    <div class="form-text">{{$message}}</div>
                                    @enderror
                                </div>
                                <input type="text" class="form-control" name="group_id" value="{{$group->id}}" hidden>

                                <button type="submit" class="btn btn-primary update">Submit</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        @endforeach

    </div>


    <script type="module">
        $(document).ready(function () {
            $('#add-group').click(function (e) {
                e.preventDefault();
                $('#add-group-form').removeClass('visually-hidden');
            })
            $('form.group-store').submit(function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: '{!! route('groups.store') !!}',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                        location.reload()
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });


            let id;
            $('a.btn-outline-dark').click(function (e) {
                e.preventDefault();
                id = $(this).attr('id');
                $("#" + id + 'li').removeClass('visually-hidden');
            })
            $('a.btn-transparent').click(function (e) {
                e.preventDefault();
                id = $(this).attr('id');
                $("." + id).removeClass('visually-hidden');
            })


            $('form.update-group').submit(function (e) {
                e.preventDefault();
                console.log($(this));
                const formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: '{!! route('groups.update') !!}',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                        location.reload()
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('form.update-task').submit(function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'PUT',
                    url: '{!! route('tasks.update', $task ) !!}',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                        location.reload()
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('form.store-task').submit(function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: '{!! route('tasks.create', $group ) !!}',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                        location.reload()
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });


            $('form.destroy-task').submit(function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                console.log(formData);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'DELETE',
                    url: '{!! route('tasks.destroy', $task->id ) !!}',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                        location.reload()
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('form.destroy-group').submit(function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'DELETE',
                    url: '{!! route('groups.destroy', $group->id) !!}',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                        location.reload()
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
