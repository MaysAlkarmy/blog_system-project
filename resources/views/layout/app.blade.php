<!DOCTYPE html>
<html lang="en">
 
 @include('layout.head')
<body>

   {{-- Include header --}}
    @include('layout.header')

    <div class="container py-4">
        @yield('content')
    </div>
    {{-- Include footer --}}
    @include('layout.footer')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
