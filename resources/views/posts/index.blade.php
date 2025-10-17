<!DOCTYPE html>
<html>
<head>
    <title>All Posts</title>
</head>
<body>
    <h1>All Posts</h1>
    <a href="{{ route('posts.create') }}">Create New Post</a>
    <hr>

    @foreach($posts as $post)
        <h2><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
        <p>{{ Str::limit($post->body, 100) }}</p>
        <p><small>By {{ $post->user->name }} | {{ $post->created_at->diffForHumans() }}</small></p>

        @if($post->user_id === auth()->id())
            <a href="{{ route('posts.edit', $post) }}">Edit</a>
            <form method="POST" action="{{ route('posts.destroy', $post) }}" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        @endif
        <hr>
    @endforeach

    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
    
</form>
</body>
</html>
