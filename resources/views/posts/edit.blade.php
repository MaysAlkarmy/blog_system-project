@extends('layout.app')

@section('title', 'Edit Post')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <h2 class="mb-4">Edit Post</h2>

        <form action="{{ route('posts.update', $post->id) }}" method="POST" class="bg-white p-4 rounded shadow-sm">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Body</label>
                <textarea name="body" class="form-control" rows="6" required>{{ old('body', $post->body) }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Post</button>
            </div>
        </form>
    </div>
</div>
@endsection
