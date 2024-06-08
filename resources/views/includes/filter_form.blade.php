
<div class="col">
    <form class="filter row"  action="{{route('groups.filter')}}" method="post">
        @csrf
        <select class="form-select col" aria-label="Default select example" multiple name="tags[]">
            <option selected disabled>Select tags</option>
            @foreach($tags as $tag)
                <option value="{{$tag->id}}">{{$tag->title}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn-outline-dark btn col-4">Filter</button>
    </form>
</div>

<script>
    {{--$(document).ready(function () {--}}
    {{--    $('form.filter').submit(function (e) {--}}
    {{--        e.preventDefault();--}}
    {{--        const formData = new FormData(this);--}}

    {{--        $.ajax({--}}
    {{--            headers: {--}}
    {{--                'X-CSRF-TOKEN': "{{ csrf_token() }}"--}}
    {{--            },--}}
    {{--            type: 'POST',--}}
    {{--            url: '{!! route('groups.filter') !!}',--}}
    {{--            data: formData,--}}
    {{--            dataType: 'json',--}}
    {{--            processData: false,--}}
    {{--            contentType: false,--}}
    {{--            success: function (response) {--}}
    {{--                console.log(response);--}}
    {{--                location.reload()--}}
    {{--            },--}}
    {{--            error: function (xhr, status, error) {--}}
    {{--                console.error(xhr.responseText);--}}
    {{--            }--}}
    {{--        });--}}
    {{--    });--}}
    {{--});--}}
</script>

