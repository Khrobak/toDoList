@extends('layouts.app')
@section('content')
    <h1>Create new list</h1>
    <form class="col-6"
{{--          action="{{route('groups.update', $list)}}" method="post" --}}
          id="update_form">
        @method('PUT')
        @csrf
        <input type="hidden" name="id" value="{!! $group->id !!}">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$group->title}}">
            @error('title')
            <div class="form-text">{{$message}}</div>
        @enderror
            <input type="text" class="form-control" name="user_id" value="1" hidden>

    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

<script type="module">
    $(document).ready(function() {
        $('#update_form').submit(function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: '{!! route('groups.update') !!}',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    window.location.href = "{{ route('groups.index' )}}";
                    // console.log(response)
                    // $('#cf-response-message').text(response.message);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>



{{--    <script type="module">--}}
{{--        $(document).ready(function(){--}}
{{--            $('#update_form').on('submit', function() {--}}
{{--                event.preventDefault();--}}
{{--                $.ajax({--}}
{{--                    url: "{{route('groups.update', $group)}}",--}}
{{--                    type:"POST",--}}
{{--                    data:{--}}
{{--                        "_token": "{{ csrf_token() }}",--}}
{{--                        data: $("#update_form").serialize(),--}}
{{--                    },--}}
{{--                    success:function(response){--}}
{{--                        console.log(response);--}}
{{--                    },--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
