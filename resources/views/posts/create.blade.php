@extends('layout.app')

@section('title', 'Create New Post')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Create New Post</h2>
    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">← Back to Posts</a>
</div>

{{-- Show validation errors --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Success message --}}
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('posts.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
    @csrf

    <div class="mb-3">
        <label class="form-label fw-semibold">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Body</label>
        <textarea name="body" class="form-control" rows="6" required>{{ old('body') }}</textarea>
    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary px-4">Save Post</button>
    </div>
</form>
@endsection
