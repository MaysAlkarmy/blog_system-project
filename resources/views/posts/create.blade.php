<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
</head>
<body>
    <h1>Create New Post</h1>

    <form method="POST" action="{{ route('posts.store') }}">
        @csrf

        <label>Title</label><br>
        <input type="text" name="title" value="{{ old('title') }}">
        @error('title') <p style="color:red">{{ $message }}</p> @enderror
        <br><br>

        <label>Body</label><br>
        <textarea name="body">{{ old('body') }}</textarea>
        @error('body') <p style="color:red">{{ $message }}</p> @enderror
        <br><br>

        <button type="submit">Save</button>
    </form>
</body>
</html>
