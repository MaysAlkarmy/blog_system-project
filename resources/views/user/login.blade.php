<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label>Email</label><br>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email') <p style="color:red">{{ $message }}</p> @enderror
        <br><br>

        <label>Password</label><br>
        <input type="password" name="password">
        @error('password') <p style="color:red">{{ $message }}</p> @enderror
        <br><br>

        <label>
            <input type="checkbox" name="remember"> Remember Me
        </label>
        <br><br>

        <button type="submit">Login</button>
    </form>

    <p>Don’t have an account? <a href="{{ route('register') }}">Register here</a></p>
</body>
</html>
