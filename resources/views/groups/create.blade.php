@extends('layouts.app')
@section('content')
    <h1>Create new list</h1>
    <form class="col-6" action="{{route('groups.store')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
            @error('title')
            <div class="form-text">{{$message}}</div>
            @enderror
            <input type="text" class="form-control" name="user_id" value="{{auth()->id()}}" hidden>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
