<!DOCTYPE html>
<html>
<head>
    <title>All Posts</title>
</head>
<body>
    <h1>All Posts</h1>

    <a href="{{ route('posts.create') }}">Create New Post</a>
    <hr>

    {{-- Loop through all posts --}}
    @foreach($posts as $post)
        <h2>
            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
        </h2>

        <p>{{ Str::limit($post->body, 100) }}</p>
        <p>
            <small>
                By {{ $post->user->name }} |
                {{ $post->created_at->setTimezone('Asia/Amman')->diffForHumans() }}
            </small>
        </p>

        {{-- Only show edit/delete for post owner --}}
        @if($post->user_id === auth()->id())
            <a href="{{ route('posts.edit', $post) }}">Edit</a>
            <form method="POST" action="{{ route('posts.destroy', $post) }}" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        @endif

        <hr>

        {{-- 💬 Comments Section --}}
        <h4>Comments ({{ $post->comments->count() }})</h4>

        @forelse($post->comments as $comment)
            <div style="margin-left:20px; border:1px solid #ddd; padding:8px; margin-bottom:6px;">
                <strong>{{ $comment->user->name ?? 'Unknown User' }}</strong>
                <p>{{ $comment->content }}</p>
                <small>{{ $comment->created_at->setTimezone('Asia/Amman')->diffForHumans() }}</small>
            </div>
        @empty
            <p style="margin-left:20px; color:gray;">No comments yet.</p>
        @endforelse

       {{-- 📝 Add Comment Form --}}
        @auth
            <form method="POST" action="{{ route('comments.store', $post->id) }}" style="margin-top:10px; margin-left:20px;">
                @csrf
                <input type="text" name="content" placeholder="Write a comment..." required style="width:300px;">
                <button type="submit">Add Comment</button>
            </form>
        @else
            <p style="margin-left:20px;">
                <a href="{{ route('login') }}">Login</a> to comment.
            </p>
        @endauth

        <hr><br>
    @endforeach

    {{-- Logout --}}
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
