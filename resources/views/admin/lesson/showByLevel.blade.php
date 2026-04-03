@extends('layouts.app')

@section('content')
<style>
    .page-wrapper {
        padding-top: 80px;
        min-height: 100vh;
    }

    .my-sidebar {
        width: 280px;
        background-color: #fff;
        position: fixed;
        height: calc(100vh - 80px);
        top: 80px;
        overflow-y: auto;
        z-index: 1000;
        transition: transform 0.3s ease;
        left: 0;
    }

    .my-content {
        margin-left: 280px;
        padding: 20px 40px 20px 40px; 
        margin-top: 0; 
    }

    .my-nav-link {
        color: #000 !important;
        display: block;
        padding: 15px 20px !important;
        text-decoration: none !important;
    }

    .my-nav-link:hover,
    .my-nav-link.active {
        background-color: {{$levelColor}} !important;
        color: #fff !important;
    }

    .my-example {
        background-color: #f1e6e6;
        border-left: 4px solid {{$levelColor}};
        padding: 15px;
        font-family: monospace;
    }

    [data-bs-theme="dark"] .my-nav-link {
            color: #fff !important;
    }

    [data-bs-theme="dark"] .my-example {
            background-color: #666;
            color: #fff !important;
    }

    @media (max-width: 992px) {
        .my-sidebar {
            transform: translateX(-100%);
            top: 80px;
        }

        .my-content {
            margin-left: 0;
            padding: 20px;
            margin-top: 0;
        }

        .sidebar-toggle {
            position: fixed;
            top: 90px;
            left: 20px;
            z-index: 1001;
            background: {{$levelColor}};
            color: white;
            border: none;
            padding: 12px 16px;
            border-radius: 8px;
            font-weight: bold;
            box-shadow: 0 2px 10px rgba(231, 109, 139, 0.4);
            display: block; 
        }

        .sidebar-toggle.hidden {
            display: none !important;
        }

        .sidebar-close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: transparent;
            border: none;
            font-size: 24px;
            color: #666;
            cursor: pointer;
            z-index: 1002;
        }

        .sidebar-close:hover {
            color: {{$levelColor}};
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        .sidebar-overlay.active {
            display: block;
        }
    }
</style>

<button class="sidebar-toggle d-lg-none" id="sidebarToggle" onclick="toggleSidebar()">
    <i class="fa-solid fa-angle-right"></i>
</button>
<div class="sidebar-overlay d-lg-none" id="overlay" onclick="closeSidebar()"></div>

<div class="page-wrapper">
    <div class="d-flex">
        <nav class="my-sidebar bg-body" id="sidebar">
            <button class="sidebar-close d-lg-none" onclick="closeSidebar()">
                <i class="fa-solid fa-times"></i>
            </button>
            
            <h3 class="p-3 mb-0" style="border-bottom: 3px solid {{$levelColor}} !important; color: {{$levelColor}} !important;">
                {{ $level->name }}
            </h3>

            @foreach($lessons as $lesson)
            <a href="#lesson-{{ $lesson->id }}"
                class="my-nav-link p-3 d-block text-decoration-none {{ $loop->first ? 'active' : '' }}"
                onclick="setActive(this)">
                {{ $lesson->title }}
            </a>
            @endforeach
        </nav>

        <!-- Main Content -->
        <main class="my-content flex-grow-1" id="mainContent">
            @foreach($lessons as $lesson)
            <div id="lesson-{{ $lesson->id }}" class="mb-5" style="scroll-margin-top: 100px;">
                <h2 style="color: {{$levelColor}} !important;">{{ $lesson->title }}</h2>

                @if($lesson->structure)
                    <div class="mb-3">
                        <h5 class="fw-bold">Structure:</h5>
                        <p>{{ $lesson->structure }}</p>
                    </div>
                @endif

                @if($lesson->explanation)
                    <div class="mb-3">
                        <h5 class="fw-bold">Explanation:</h5>
                        <p>{{ $lesson->explanation }}</p>
                    </div>
                @endif

                @if($lesson->example)
                    <div class="mb-3">
                        <h5 class="fw-bold">Example:</h5>
                        <div class="my-example">{{ $lesson->example }}</div>
                    </div>
                @endif
            </div>
            @endforeach
        </main>
    </div>
</div>

<script>
    let sidebarOpen = false;

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        sidebarOpen = !sidebarOpen;

        if (sidebarOpen) {
            // Show sidebar and close button, hide toggle button
            sidebar.style.transform = 'translateX(0)';
            overlay.classList.add('active');
            toggleBtn.classList.add('hidden');
        } else {
            // Hide sidebar, show toggle button
            sidebar.style.transform = 'translateX(-100%)';
            overlay.classList.remove('active');
            toggleBtn.classList.remove('hidden');
        }
    }

    function closeSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        sidebarOpen = false;
        sidebar.style.transform = 'translateX(-100%)';
        overlay.classList.remove('active');
        toggleBtn.classList.remove('hidden');
    }

    function setActive(link) {
        document.querySelectorAll('.my-nav-link').forEach(l => l.classList.remove('active'));
        if (typeof link === 'object') {
            link.classList.add('active');
        }

        if (link.href) {
            setTimeout(() => {
                document.querySelector(link.href)?.scrollIntoView({
                    behavior: 'smooth'
                });
            }, 100);
        }

        if (window.innerWidth < 992) {
            closeSidebar();
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const firstLink = document.querySelector('.my-nav-link');
        if (firstLink) firstLink.classList.add('active');
    });
</script>
@endsection
