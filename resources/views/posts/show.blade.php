@extends('layout.app')

@section('title', $post->title)

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- Post Card --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body">

                    {{-- Edit/Delete Buttons (Only for post owner) --}}
                    @if (Auth::id() === $post->user_id)
                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this post?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    @endif

                    {{-- Post Title --}}
                    <h2 class="card-title">{{ $post->title }}</h2>

                    {{-- Author and Date --}}
                    <p class="text-muted">
                        <span class="fw-bold">{{ $post->user->name }}</span>
                        <span class="post-date">{{ $post->created_at->diffForHumans() }}</span>
                    </p>

                    {{-- Full Content --}}
                    <div class="card-text mb-4">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </div>
            </div>

            {{-- Comments Section --}}
            <div class="comment-card">
                <div class="card-body">
                    <h5 class="mb-3">Comments ({{ $post->comments->count() }})</h5>

                    @if ($post->comments->count() > 0)
                        @foreach ($post->comments as $comment)
                            <div class="border rounded-3 p-3 mb-2 bg-light">
                                <strong>{{ $comment->user->name }}</strong>
                                <small class="text-muted ms-1">{{ $comment->created_at->diffForHumans() }}</small>
                                <p class="mb-0">{{ $comment->content }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">No comments yet. Be the first to comment!</p>
                    @endif

                    {{-- Add Comment Form --}}
                    <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-3">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="content" class="form-control" placeholder="Add a comment..."
                                required>
                            <button type="submit" class="btn btn-outline-primary">Comment</button>
                        </div>
                    </form>

                </div>
            </div>

            {{-- Back Button --}}
            <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">← Back to Posts</a>

        </div>
    </div>
@endsection

@push('styles')
    <style>
        .post-date {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .border {
            background-color: #f8f9fa !important;
            border-radius: 0.5rem !important;
        }

        .input-group input {
            border-radius: 0.375rem 0 0 0.375rem;
        }

        .input-group button {
            border-radius: 0 0.375rem 0.375rem 0;
        }
    </style>
@endpush
