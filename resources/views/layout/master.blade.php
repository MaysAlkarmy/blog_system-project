<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My Website')</title>
</head>
<body>
    {{-- Include header partial --}}
    @include('layout.header')

    {{-- Main page content from child views --}}
    <main>
        @yield('content')
    </main>

    {{-- Include footer partial --}}
    @include('layout.footer')
</body>
</html>
