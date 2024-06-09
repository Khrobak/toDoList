<div class="col">
    <h4>Filtering lists by tags</h4>
    <form class="filter row" action="{{route('groups.filter')}}" method="post">
        @csrf
        <select class="form-select col" aria-label="Default select example" multiple name="tags[]">
            <option selected disabled>Select tags</option>
            @foreach($tags as $tag)
                <option value="{{$tag->id}}">{{$tag->title}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn-outline-dark btn col-4 col" style="max-height: 50px;">Filter</button>
    </form>
    <div>
        <form method="post" class="input-group" action="{{route('groups.search')}}">
            @csrf
            <input type="search" class="form-control rounded" placeholder="Search tasks in lists" aria-label="Search" name="search"/>
            <button type="submit" class="btn btn-secondary" data-mdb-ripple-init>search</button>
        </form>
    </div>
    <div>
        <div class="col">

            <a class="btn" href="{{route('groups.index')}}">Show all lists</a>
        </div>
    </div>

</div>



