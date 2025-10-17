

<h1>Welcome Admin {{ Auth::guard('admin')->user()->name }}</h1>

<form method="POST" action="{{ route('admin.logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>