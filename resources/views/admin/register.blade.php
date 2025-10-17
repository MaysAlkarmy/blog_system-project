<h1> Admin Register </h1>

<form method="POST" action="{{ route('admin.register') }}">
    @csrf

    <label for="name">Name:</label>
    <input type="text" name="name" required>
    <br><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <br><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <br><br>

    <label for="password_confirmation">Confirm Password:</label>
    <input type="password" name="password_confirmation" required>
    <br><br>

    <button type="submit">Register</button>
</form>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
