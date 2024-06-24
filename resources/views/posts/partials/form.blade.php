@error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
<div>
    @csrf
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="{{ old('title', optional($post ?? null)->title) }}">
</div>
<div>
    <label for="content">Content:</label>
    <textarea id="content" name="content">{{ old('content', optional($post ?? null)->content) }}</textarea>
</div>
@if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <ul>
                <li>{{ $error }}</li>
            </ul>
        @endforeach
    </div>
@endif
