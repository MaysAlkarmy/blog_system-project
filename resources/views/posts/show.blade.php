<!DOCTYPE html>
<html>
<head>
    <title>{{ $post->title }}</title>
</head>
<body>
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>
    <p><small>By {{ $post->user->name }} | {{ $post->created_at->diffForHumans() }}</small></p>

    <h3>Comments</h3>

{{-- Comment Form --}}
@auth
<form action="{{ route('comments.store', $post->id) }}" method="POST">
    @csrf
    <div class="mb-3">
        <textarea name="content" class="form-control" rows="3" placeholder="Write your comment..." required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Add Comment</button>
</form>
@else
<p><a href="{{ route('login') }}">Login</a> to add a comment.</p>
@endauth

<hr>

{{-- Display Comments --}}
@if($post->comments->count())
    @foreach($post->comments as $comment)
        <div class="border rounded p-2 mb-2">
            <strong>{{ $comment->user->name }}</strong>
            <p>{{ $comment->content }}</p>
            <small class="text-muted">{{ $comment->created_at->format('M d, Y h:i A') }}</small>

            @if(Auth::check() && Auth::id() === $comment->user_id)
                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            @endif
        </div>
    @endforeach
@else
    <p>No comments yet. Be the first to comment!</p>
@endif

    <a href="{{ route('posts.index') }}">Back to Posts</a>
</body>
</html>
