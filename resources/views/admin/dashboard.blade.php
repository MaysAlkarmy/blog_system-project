@extends('layout.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Admin Dashboard</h2>

    <div class="row mb-4">
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h3>{{ $usersCount }}</h3>
                    <p class="text-muted">Registered Users</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h3>{{ $postsCount }}</h3>
                    <p class="text-muted">Total Posts</p>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mb-3">Latest Posts</h4>
    <div class="card shadow-sm">
        <div class="card-body">
            <ul class="list-group">
                @foreach ($latestPosts as $post)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $post->title }}
                        <span class="text-muted small">{{ $post->created_at->format('M d, Y') }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
