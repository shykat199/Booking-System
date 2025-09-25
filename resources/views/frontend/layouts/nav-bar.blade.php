<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#"><i class="fas fa-blog"></i> My Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('home-page') ? 'active' : ''}}" href="{{route('home-page')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('blog-list') ? 'active' : ''}}" href="{{route('blog-list')}}">Posts</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown d-flex align-items-center">
                    @if(Auth::guest())
                        <a class="nav-link" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    @else
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}"
                                 alt="Avatar" class="rounded-circle me-2" width="30" height="30">
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>
                                <a class="dropdown-item" href="{{ route('home') }}">Dashboard</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                        </ul>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
