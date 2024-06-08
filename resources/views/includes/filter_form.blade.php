<div class="col">
    <form class="filter row" action="{{route('groups.filter')}}" method="post">
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



