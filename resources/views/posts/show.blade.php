<!DOCTYPE html>
<html>
<head>
    <title>{{ $post->title }}</title>
</head>
<body>
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>
    <p><small>By {{ $post->user->name }} | {{ $post->created_at->diffForHumans() }}</small></p>

    <a href="{{ route('posts.index') }}">Back to Posts</a>
</body>
</html>
