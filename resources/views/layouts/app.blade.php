<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sakura Grammar</title>
<link rel="icon" type="image/png"  href="{{ asset('favicon.png') }}">

    <!-- Scripts --> 
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <style>
        [data-bs-theme="dark"] body {
            background-color: #121212 !important;
            color: #ffffff !important;
        }

        [data-bs-theme="dark"] .card {
            background-color: #1e1e1e;
            border: 1px solid #333;
            color: #000;
        }

        [data-bs-theme="dark"] .navbar .nav-link {
            color: #000000 !important;
        }

        [data-bs-theme="light"] .navbar .nav-link {
            color: #000000 !important;
        }

        [data-bs-theme="dark"] .nav-link:hover {
            color: #fff !important;
        }

        [data-bs-theme="dark"] .alert-success {
            background-color: green;
            color: white;
            border-color: green;
        }

        [data-bs-theme="dark"] .alert-danger {
            background-color: red;
            color: white;
            border-color: red;
        }
        [data-bs-theme="dark"] #deactivateModal .modal-content {
    background-color: #1e1e1e;
}

[data-bs-theme="dark"] #deactivateModal h4 {
    color: #ffffff;
}

[data-bs-theme="dark"] #deactivateModal p,
[data-bs-theme="dark"] #deactivateModal strong {
    color: #bdbdbd;
}
        
    </style>
</head>

<body class="bg-white text-dark">
    @include('layouts.navbar')

    <main class="py-4">
        <x-alert />
        @yield('content')
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const html = document.documentElement;
            const toggle = document.getElementById('themeToggle');
            const logo = document.getElementById('themeLogo');

            let savedTheme = localStorage.getItem('theme') || 'light';
            html.setAttribute('data-bs-theme', savedTheme);

            function updateIcon(theme) {
                if (!toggle) return;

                if (theme === 'dark') {
                    toggle.className = 'bi bi-moon-stars-fill';
                    toggle.style.color = '#000';
                    if (logo) logo.src = "{{ asset('img/logo-dark.png') }}";
                } else {
                    toggle.className = 'bi bi-sun-fill';
                    toggle.style.color = '#fff';
                    if (logo) logo.src = "{{ asset('img/logo-light.png') }}";
                }
            }

            updateIcon(savedTheme);

            if (toggle) {
                toggle.addEventListener('click', function() {
                    let current = html.getAttribute('data-bs-theme');
                    let next = current === 'dark' ? 'light' : 'dark';

                    html.setAttribute('data-bs-theme', next);
                    localStorage.setItem('theme', next);

                    updateIcon(next);
                });
            }

        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>