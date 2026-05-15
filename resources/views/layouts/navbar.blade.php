<style>
    .navbar-nav .nav-item .nav-link.text-body.active {
        background-color: #dd4c70 !important;
        color: white !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        box-shadow: 0 2px 4px rgba(231, 109, 139, 0.3) !important;
        transition: all 0.2s ease-in-out !important;
        margin: 0 4px !important;
    }

    .nav-link.text-body {
        transition: all 0.2s ease-in-out !important;
    }

    .dropdown-item {
        transition: all 0.2s ease-in-out !important;
    }

    .dropdown-item:hover,
    .nav-link.text-body:hover {
        background-color: #ff7c9d !important;
        color: white !important;
        border-radius: 6px !important;
    }

    .dropdown-item.active {
        background-color: #ff7c9d !important;
        color: white !important;
        border-radius: 6px !important;
        font-weight: 600 !important;
    }

    .dropdown-menu {
        border-radius: 10px !important;
        box-shadow: 0 4px 12px rgba(231, 109, 139, 0.15) !important;
        border: none !important;
        margin-top: 5px !important;
    }

    @media (max-width: 991px) {
        .nav-link.text-body.active {
            margin: 4px 0 !important;
        }
    }
</style>

<nav class="navbar navbar-expand-md  shadow-sm sticky-top"  style="background: linear-gradient(90deg, #f8d5de, #f0e3e6);">
    <div class="container">
        <a class="navbar-brand fw-bold fs-3 text-lowercase" href="{{ route('home') }}" style="color: #ff7c9d;">
            <span class="fw-bold text-uppercase">S</span>akura Grammar
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Links -->
            <ul class="navbar-nav me-auto">

                @php
                $currentLevelParam = request()->route('lessons.byLevel');
                $activeLevel = $currentLevelParam ? urldecode($currentLevelParam) : null;
                @endphp

                @guest
                <li class="nav-item dropdown">
                    <a class="nav-link text-body dropdown-toggle {{ $activeLevel ? 'active' : '' }}"
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Level
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($levels as $level)
                        <li>
                            <a class="dropdown-item {{ $activeLevel === $level->name ? 'active' : '' }}"
                                href="{{ route('lesson.byLevel', urlencode($level->name)) }}">
                                {{ $level->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body {{ request()->is('/#about') ? 'active' : '' }}" href="{{ url('/') }}#about">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-body {{ request()->is('/#jlpt') ? 'active' : '' }}" href="{{ url('/') }}#jlpt">JLPT</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-body {{ request()->is('/#contact') ? 'active' : '' }}" href="{{ url('/') }}#contact">Contact</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-body {{ request()->routeIs('showExam') ? 'active' : '' }}" href="{{route('showExam')}}">Exam</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-body {{ request()->routeIs('showTopPassers') ? 'active' : '' }}" href="{{route('showTopPassers')}}">Top Passers</a>
                </li>

                @else

                @if(Auth::user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link text-body {{ request()->routeIs('admin') ? 'active' : '' }}" href="{{route('admin')}}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body {{ request()->routeIs('levels.index') ? 'active' : '' }}" href="{{route('levels.index')}}">Levels</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body {{ request()->routeIs('lessons.index') ? 'active' : '' }}" href="{{route('lessons.index')}}">Lessons</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body {{ request()->routeIs('questions.index') ? 'active' : '' }}" href="{{route('questions.index')}}">Questions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body {{ request()->routeIs('exams.index') ? 'active' : '' }}" href="{{route('exams.index')}}">Exams</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body {{ request()->routeIs('users.index') ? 'active' : '' }}" href="{{route('users.index')}}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body {{ request()->routeIs('scores.index') ? 'active' : '' }}" href="{{route('scores.index')}}">Certificates</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body {{ request()->routeIs('showTopPassers') ? 'active' : '' }}" href="{{route('showTopPassers')}}">Top Passers</a>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link text-body dropdown-toggle {{ $activeLevel ? 'active' : '' }}"
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Level
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($levels as $level)
                        <li>
                            <a class="dropdown-item {{ $activeLevel === $level->name ? 'active' : '' }}"
                                href="{{ route('lesson.byLevel', urlencode($level->name)) }}">
                                {{ $level->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-body {{ request()->is('/#about') ? 'active' : '' }}" href="{{ url('/') }}#about">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-body {{ request()->is('/#jlpt') ? 'active' : '' }}" href="{{ url('/') }}#jlpt">JLPT</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-body {{ request()->is('/#contact') ? 'active' : '' }}" href="{{ url('/') }}#contact">Contact</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-body {{ request()->routeIs('showExam') ? 'active' : '' }}" href="{{route('showExam')}}">Exam</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-body {{ request()->routeIs('showTopPassers') ? 'active' : '' }}" href="{{route('showTopPassers')}}">Top Passers</a>
                </li>

                @endif
                @endguest

            </ul>

            <!-- Right Side Links -->
            <ul class="navbar-nav ms-auto mt-2">
                <li class="nav-item me-3">
                    <i id="themeToggle" class="bi bi-brightness-high"
                        style="color: #000; font-size:25px;">
                    </i>
                </li>
                @guest
                <li class="nav-item me-2">
                    <a class="btn mb-3" href="{{ route('login') }}" style="background-color: #1A237E; color: #fff;">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="btn" href="{{ route('register') }}" style="background-color: #ff7c9d; color: #fff;">
                        <i class="fas fa-user-plus"></i> Register
                    </a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link text-body dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            @if(Auth::user()->role == 'admin')
                            <a class="nav-link text-body" href="{{route('admin')}}">Dashboard</a>
                            @else
                            <a class="nav-link text-body" href="{{route('user')}}">Dashboard</a>
                            @endif
                        </li>

                        @if(Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link text-body text-start" href="{{route('user.profile',Auth::user()->id)}}">
                                <i class="fa-solid fa-circle-user me-2"></i>Profile
                            </a>
                        </li>
                        @endif

                        <li class="nav-item">
        <!-- Logout Button -->
                <button type="button"
        class="nav-link text-body text-start w-100 border-0 bg-transparent"
        data-bs-toggle="modal"
        data-bs-target="#logoutModal">
        <i class="fas fa-sign-out-alt"></i> Logout
    </button>
</li>
                    </ul>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    Confirm Logout
                </h5>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">
                Are you sure you want to logout?
            </div>

            <div class="modal-footer">
                <!-- Cancel -->
                <button type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Cancel
                </button>

                <!-- OK Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        OK
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
        link.addEventListener('click', function() {

            navLinks.forEach(node => node.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>