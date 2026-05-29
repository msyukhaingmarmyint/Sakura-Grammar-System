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

    .navbar-brand {
        margin-left: 0 !important;
    }

    .nav-link.text-body {
        transition: all 0.2s ease-in-out !important;
    }

    .dropdown-item {
        transition: all 0.2s ease-in-out !important;
    }

    .dropdown-item:hover,
    .nav-link.text-body.with-color:hover {
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

    /* Fluid container spacing setup across screens */
    .navbar .container-fluid {
        padding-left: 24px;
        padding-right: 24px;
    }

    @media (min-width: 992px) {
        .navbar .container-fluid {
            padding-left: 50px;
            padding-right: 50px;
        }
    }

    @media (max-width: 991px) {
        .nav-link.text-body.active {
            margin: 4px 0 !important;
        }

        .navbar-profile-img {
            width: 38px;
            height: 38px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid white;
            transition: 0.3s;
        }

        .navbar-profile-img:hover {
            transform: scale(1.05);
        }
    }
</style>

<nav class="navbar navbar-expand-md shadow-sm sticky-top" style="background: linear-gradient(90deg, #f0e3e6, #fc94ae);">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold fs-2 text-lowercase" href="{{ route('home') }}" style="color: #dd4c70;">
            <img src="{{ asset('favicon.png') }}" alt="Logo" width="43" height="40" class="d-inline-block align-top ">
            <span class="fw-bold text-uppercase"> S</span>akura Grammar
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav w-100 align-items-md-center">
                @php
                $currentLevelParam = request()->route('lessons.byLevel');
                $activeLevel = $currentLevelParam ? urldecode($currentLevelParam) : null;
                @endphp

                @guest
                <li class="nav-item dropdown">
                    <a class="nav-link text-body with-color dropdown-toggle {{ $activeLevel ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Level
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($navLevels as $level)
                        <li>
                            <a class="dropdown-item {{ $activeLevel === $level->name ? 'active' : '' }}" href="{{ route('lesson.byLevel', urlencode($level->name)) }}">
                                {{ $level->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body with-color {{ request()->is('/#about') ? 'active' : '' }}" href="{{ url('/') }}#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body with-color {{ request()->is('/#jlpt') ? 'active' : '' }}" href="{{ url('/') }}#jlpt">JLPT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body with-color {{ request()->is('/#contact') ? 'active' : '' }}" href="{{ url('/') }}#contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body with-color {{ request()->routeIs('showExam') ? 'active' : '' }}" href="{{ route('showExam') }}">Exam</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body with-color {{ request()->routeIs('showTopPassers') ? 'active' : '' }}" href="{{ route('showTopPassers') }}">Top Passers</a>
                </li>
                @else
                @if(Auth::user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link text-body with-color {{ request()->routeIs('admin') ? 'active' : '' }}" href="{{ route('admin') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body with-color {{ request()->routeIs('levels.index') ? 'active' : '' }}" href="{{ route('levels.index') }}">Levels</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body with-color {{ request()->routeIs('lessons.index') ? 'active' : '' }}" href="{{ route('lessons.index') }}">Lessons</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body with-color {{ request()->routeIs('questions.index') ? 'active' : '' }}" href="{{ route('questions.index') }}">Questions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body with-color {{ request()->routeIs('exams.index') ? 'active' : '' }}" href="{{ route('exams.index') }}">Exams</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body with-color {{ request()->routeIs('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body with-color {{ request()->routeIs('scores.index') ? 'active' : '' }}" href="{{ route('scores.index') }}">Certificates</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body with-color {{ request()->routeIs('showTopPassers') ? 'active' : '' }}" href="{{ route('showTopPassers') }}">Top Passers</a>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link text-body with-color dropdown-toggle {{ $activeLevel ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Level
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($navLevels as $level)
                        <li>
                            <a class="dropdown-item {{ $activeLevel === $level->name ? 'active' : '' }}" href="{{ route('lesson.byLevel', urlencode($level->name)) }}">
                                {{ $level->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body with-color {{ request()->is('/#about') ? 'active' : '' }}" href="{{ url('/') }}#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body with-color {{ request()->is('/#jlpt') ? 'active' : '' }}" href="{{ url('/') }}#jlpt">JLPT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body with-color {{ request()->is('/#contact') ? 'active' : '' }}" href="{{ url('/') }}#contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body with-color {{ request()->routeIs('showExam') ? 'active' : '' }}" href="{{ route('showExam') }}">Exam</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body with-color {{ request()->routeIs('showTopPassers') ? 'active' : '' }}" href="{{ route('showTopPassers') }}">Top Passers</a>
                </li>
                @endif
                @endguest

                <li class="nav-item py-2 py-md-0 px-2 px-md-0 me-md-3 d-flex align-items-center ms-md-auto">
                    <i id="themeToggle" class="bi bi-brightness-high" style="color: #000; font-size: 24px; cursor: pointer;"></i>
                </li>

                @guest
                <li class="nav-item my-1 my-md-0 me-md-2">
                    <a class="btn w-100" href="{{ route('login') }}" style="background-color: #1A237E; color: #fff;">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item my-1 my-md-0">
                    <a class="btn w-100" href="{{ route('register') }}" style="background-color: #dd4c70; color: #fff;">
                        <i class="fas fa-user-plus"></i> Register
                    </a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown w-100 text-start styles-dropdown-fix" style="width: auto !important;">
                    <a class="nav-link text-body dropdown-toggle d-flex align-items-center gap-2 px-2 px-md-0"
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">

                        <!-- User Profile -->
                        <img
                            src="{{ Auth::user()->profile
        ? asset('storage/' . Auth::user()->profile)
        :asset('img/image.png') }}"
                            alt="Profile"
                            width="38"
                            height="38"
                            class="rounded-circle border shadow-sm"
                            style="object-fit: cover;">

                        <!-- Username -->
                        <span class="fw-semibold">
                            {{ Auth::user()->name }}
                        </span>

                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="my-1">
                            @if(Auth::user()->role == 'admin')
                            <a class="dropdown-item text-body" href="{{ route('admin') }}"><i class="bi bi-clipboard2-fill me-2"></i>Dashboard</a>
                            @else
                            <a class="dropdown-item text-body" href="{{ route('user') }}"><i class="bi bi-clipboard2-fill me-2"></i>Dashboard</a>
                            @endif
                        </li>

                        @if(Auth::user()->role == 'admin')
                        <li class="my-1">
                            <a class="dropdown-item text-body text-start" href="{{ route('user.profile', Auth::user()->id) }}">
                                <i class="fa-solid fa-circle-user me-2"></i>Profile
                            </a>
                        </li>

                        @php
                        $count = \App\Models\ReactivationRequest::where('status','pending')->count();
                        @endphp

                        <li class="my-1">
                            <a class="dropdown-item text-body text-start" href="{{ route('admin.mailbox') }}">
                                <i class="bi bi-envelope-arrow-down-fill me-2"></i>Mail Box <span class="badge bg-danger ms-1">{{ $count }}</span>
                            </a>
                        </li>
                        @endif

                        @if(Auth::user()->role == 'user')
                        <li class="my-1">
                            <a class="dropdown-item text-body text-start" href="{{ route('user.bookmarks', Auth::user()->id) }}">
                                <i class="bi bi-star-fill me-2"></i>Bookmark
                            </a>
                        </li>
                        @endif

                        <hr class="dropdown-divider">
                        <li>
                            <a class="dropdown-item text-body text-start" href="{{ route('password.form') }}">
                                <i class="bi bi-key-fill me-2"></i> Change Password
                            </a>
                        </li>

                        <li>
                            <button type="button" class="dropdown-item text-body text-start w-100 border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </button>
                        </li>
                    </ul>
                </li>
                @endguest
            </ul>

        </div>
    </div>
</nav>

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-body p-4 text-center">
                <h4 class="fw-bold mb-2" id="logoutModalLabel">Confirm Logout?</h4>
                <p class="text-muted mb-4">Are you sure you want to log out of your account?</p>

                <div class="d-flex justify-content-center gap-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Yes, Logout</button>
                    </form>
                    <button type="button" class="btn btn-secondary border" data-bs-dismiss="modal">Cancel</button>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const navLinks = document.querySelectorAll('.nav-link.with-color');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            navLinks.forEach(node => node.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>