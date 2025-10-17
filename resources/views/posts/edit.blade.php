<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>

    <form method="POST" action="{{ route('posts.update', $post) }}">
        @csrf
        @method('PUT')

        <label>Title</label><br>
        <input type="text" name="title" value="{{ old('title', $post->title) }}">
        @error('title') <p style="color:red">{{ $message }}</p> @enderror
        <br><br>

        <label>Body</label><br>
        <textarea name="body">{{ old('body', $post->body) }}</textarea>
        @error('body') <p style="color:red">{{ $message }}</p> @enderror
        <br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
