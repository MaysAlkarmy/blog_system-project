@extends('layout.app')

@section('title', 'All Posts')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">All Posts</h2>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">+ Create Post</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($posts->count() > 0)
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            {{-- Post Title --}}
                            <h5 class="card-title">{{ $post->title }}</h5>

                            {{-- Author and Date --}}
                            <p class="text-muted">
                                <span class="fw-bold">by {{ $post->user->name }}</span>
                                <span class="post-date">{{ $post->created_at->diffForHumans() }}</span>
                            </p>

                            {{-- Post Snippet --}}
                            <p class="card-text">{{ Str::limit($post->body, 120) }}</p>

                            {{-- Read More --}}
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm mb-3">Read More</a>

                            {{-- Comments --}}
                            <div class="comments mt-3">
                                <h6 class="mb-2">Comments:</h6>
                                @foreach ($post->comments as $comment)
                                    <div class="border rounded-3 p-2 mb-2 bg-light">
                                        <strong>{{ $comment->user->name }}</strong>
                                        <small class="text-muted ms-1">{{ $comment->created_at->diffForHumans() }}</small>
                                        <p class="mb-0">{{ $comment->content }}</p>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Add Comment Form --}}
                            <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-2">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="content" class="form-control" placeholder="Add a comment..."
                                        required>
                                    <button type="submit" class="btn btn-outline-primary">Comment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <h5 class="text-muted">No posts found.</h5>
            <a href="{{ route('posts.create') }}" class="btn btn-outline-primary mt-3">Create your first post</a>
        </div>
    @endif
@endsection

@push('styles')
    <style>
        /* Post date smaller */
        .post-date {
            font-size: 0.8rem;
            color: #6c757d;
        }

        /* Card hover effect */
        .hover-shadow:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        /* Rounded comment boxes */
        .comments .border {
            background-color: #b9d0e7;
            border-radius: 0.5rem;
        }

        /* Input group styling */
        .input-group input {
            border-radius: 0.375rem 0 0 0.375rem;
        }

        .input-group button {
            border-radius: 0 0.375rem 0.375rem 0;
        }
    </style>
@endpush
