@extends('layouts.app')

@section('content')
    <div class="row ">
        <div class="col-3"><h1>Your task lists</h1></div>
        <div class="col"><a href="#" class="btn btn-primary" id="add-group"> Add new list </a></div>
        @include('includes.filter_form')
    </div>
    @include('includes.create_group_form')
    <div class="row">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="form-text text-danger">{{$error}}</div>
            @endforeach
        @endif
        <div>
            @session('status')
            <div class="p-4 bg-green-100">
                {{ $value }}
            </div>
            @endsession
        </div>
        @foreach($groups as $group)
            <div class=" card col-6 p-1 m-3" id="list{{$group->id}}">
                <div class="row px-4 py-1">
                    <h4 class="col">
                        {{$group->title}}
                    </h4>
                    <a href="#" class="col-2 btn btn-transparent update-group" id="update-group{{$group->id}}">
                        <i class="bi bi-pen"></i> </a>
                    <form class="col-2 destroy-group" method="post" id="destroy-group{{$group->id}}"
                          action="{{route('groups.destroy', $group)}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-transparent"><i class="bi bi-x-square"></i></button>
                    </form>
                </div>
                @include('includes.update_group_form')
                <ul class="list-group">
                    @foreach($group->tasks as $task)
                        <li class="list-group-item">
                            <div class="row">
                                <p class="col"><a href="{{asset('storage/'. $task->main_img)}}" target="_blank">
                                        <img src="{{asset('storage/'. $task->preview_img)}}" alt="Place for image"> </a>
                                </p>
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
                            @if(!empty($task->tags->first()))
                                <div>
                                    Tags:
                                    {{$task->tags->implode('title', ', ')}}
                                </div>
                            @endif
                            @include('includes.update_task_form')
                        </li>
                    @endforeach
                    <li class="list-group-item">
                        <a id='{{$group->id}}' class="btn btn-outline-dark"
                           href="#"> Add new task</a>
                    </li>
                    @include('includes.create_task_form')
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
                        location.reload();
                    },
                    error: function (xhr) {
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
        });
    </script>
@endsection
