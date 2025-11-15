<nav class="navbar navbar-expand-lg navbar-dark custom-header">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('posts.index') }}">MyBlog</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                {{-- Home --}}
                <li class="nav-item">
                    <a href="{{ route('posts.index') }}" 
                       class="nav-link {{ request()->routeIs('posts.index') ? 'active' : '' }}">
                       Home
                    </a>
                </li>

                @auth
                    {{-- Create Post --}}
                    <li class="nav-item">
                        <a href="{{ route('posts.create') }}" 
                           class="nav-link {{ request()->routeIs('posts.create') ? 'active' : '' }}">
                           Create Post
                        </a>
                    </li>

                    {{-- User Dropdown --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-info" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-person-circle me-2"></i>Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-gear me-2"></i>Settings
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="px-3">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm w-100">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>

                @else
                    {{-- Login --}}
                    <li class="nav-item">
                        <a href="{{ route('login') }}" 
                           class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}">
                           Login
                        </a>
                    </li>

                    {{-- Register --}}
                    <li class="nav-item">
                        <a href="{{ route('register') }}" 
                           class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}">
                           Register
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
