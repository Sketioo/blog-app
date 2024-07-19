<!-- search.blade.php -->
<div class="row my-4">
    <div class="col-md-6">
        <form action="{{ route('posts.search') }}" method="GET" class="d-flex">
            <div class="input-group">
                <input type="text" name="term" class="form-control" placeholder="Search posts..." aria-label="Search posts" value="{{ request('term') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>
  </div>
  