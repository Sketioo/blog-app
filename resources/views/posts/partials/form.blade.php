<div class="mb-3">
    <label for="title" class="form-label">Title:</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
        value="{{ old('title', optional($post ?? null)->title) }}">
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    @csrf
    <label for="content" class="form-label">Content:</label>
    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content">{{ old('content', optional($post ?? null)->content) }}</textarea>
    @error('content')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
