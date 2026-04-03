<style>
    .nav-link text-body.active {
        background-color: #ff7c9d !important;
        color: white !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        box-shadow: 0 2px 4px rgba(231, 109, 139, 0.3) !important;
        transition: all 0.2s ease-in-out !important;
    }

    .nav-link text-body {
        transition: all 0.2s ease-in-out !important;
    }

    /* Fix dropdown items hover */
    .dropdown-item {
        transition: all 0.2s ease-in-out !important;
    }

    .dropdown-item:hover,
    .nav-link text-body:hover {
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

    .navbar-nav .nav-link text-body.active {
        margin: 0 4px !important;
    }

    @media (max-width: 991px) {
        .nav-link text-body.active {
            margin: 4px 0 !important;
        }
    }
</style>

<nav class="navbar navbar-expand-md bg-body shadow-sm sticky-top">
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
                    <a class="nav-link text-body" href="{{ url('/') }}#about">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-body" href="{{ url('/') }}#jlpt">JLPT</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-body" href="{{ url('/') }}#contact">Contact</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-body" href="{{route('showExam')}}">Exam</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-body" href="{{route('showTopPassers')}}">Top Passers</a>
                </li>

                @else

                @if(Auth::user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link text-body" href="{{route('admin')}}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body" href="{{route('levels.index')}}">Levels</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body" href="{{route('lessons.index')}}">Lessons</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body" href="{{route('questions.index')}}">Questions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body" href="{{route('exams.index')}}">Exams</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body" href="{{route('users.index')}}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body" href="{{route('scores.index')}}">Certificates</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body" href="{{route('showTopPassers')}}">Top Passers</a>
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
                    <a class="nav-link text-body" href="{{ url('/') }}#about">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-body" href="{{ url('/') }}#jlpt">JLPT</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-body" href="{{ url('/') }}#contact">Contact</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-body" href="{{route('showExam')}}">Exam</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-body" href="{{route('showTopPassers')}}">Top Passers</a>
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
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link text-body text-start w-100">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>