@extends('layouts.app')

@section('content')
<style>
    .user-card {
        border: 2px solid #ff7c9d;
        background-color: #fff;
        transition: all 0.2s ease;
        border-radius: 15px;
        height: 100%;
    }

    .user-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .stats-card {
        border-radius: 15px;
        border-color: #000;
        transition: 0.3s;
        height: 100%;
    }

    .stats-card:hover {
        transform: translateY(-5px);
    }

    .level-btn {
        transition: all 0.2s ease;
    }

    .level-btn:hover {
        background-color: var(--clr) !important;
        color: #fff !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .active-level {
        background-color: var(--clr) !important;
        color: #fff !important;
    }

    [data-bs-theme="dark"] .d-flex p,
    .d-flex small {
        color: #000 !important;
    }

    [data-bs-theme="dark"] .stats-card {
        border-color: #fff !important;
    }

    .btn.disabled,
    .btn[disabled] {
        pointer-events: auto !important;
        cursor: not-allowed !important;
        opacity: 0.5;
        box-shadow: none !important;
        transform: none !important;
    }
</style>

<div class="container">
    <div class="container">

        <div class="position-relative mb-4">
            <a href="{{ route('admin') }}"
                class="px-4 position-absolute start-0 top-0 fs-4 text-decoration-none text-body">
                <i class="fa fa-arrow-left me-2"></i>
                <span class="d-none d-sm-inline">Back</span>
            </a>

            <h1 class="fw-bold text-center" style="color: #ff7c9d;">
                Lessons' List
            </h1>
        </div>

        <!-- Stats Cards Grid -->
        <div class="row g-3 mb-4 justify-content-center">
            <div class="col-4 col-md-3 col-lg-2">
                <a href="{{ route('lessons.index', array_merge(request()->query(), ['status' => 'all'])) }}" class="text-decoration-none">
                    <div class="card stats-card text-center p-3 shadow-sm {{ request('status', 'all') == 'all' ? 'border-primary' : '' }}">
                        <h6 class="text-body">Total Lessons</h6>
                        <h2 class="fw-bold text-primary">{{ $totalLessons }}</h2>
                    </div>
                </a>
            </div>

            <div class="col-4 col-md-3 col-lg-2">
                <a href="{{ route('lessons.index', array_merge(request()->query(), ['status' => 'active'])) }}" class="text-decoration-none">
                    <div class="card stats-card text-center p-3 shadow-sm {{ request('status') == 'active' ? 'border-success' : '' }}">
                        <h6 class="text-body">Active Lessons</h6>
                        <h2 class="fw-bold text-success">{{ $activeLessons }}</h2>
                    </div>
                </a>
            </div>

            <div class="col-4 col-md-3 col-lg-2">
                <a href="{{ route('lessons.index', array_merge(request()->query(), ['status' => 'inactive'])) }}" class="text-decoration-none">
                    <div class="card stats-card text-center p-3 shadow-sm {{ request('status') == 'inactive' ? 'border-danger' : '' }}">
                        <h6 class="text-body">Inactive Lessons</h6>
                        <h2 class="fw-bold text-danger">{{ $inactiveLessons }}</h2>
                    </div>
                </a>
            </div>
        </div>

        <!-- Levels Filter Buttons Container -->
        <div class="mb-4 d-flex justify-content-center flex-wrap gap-2">
            <a href="{{ route('lessons.index', array_merge(request()->query(), ['level' => null, 'page' => null])) }}"
                class="btn btn-sm level-btn {{ !request('level') ? 'active-level' : '' }}"
                style="--clr: #6c757d; color: #6c757d; border: 2px solid #6c757d;">
                All Levels
            </a>

            @foreach($levels as $index => $level)
            @php
            $color = $colors[$index % count($colors)];
            @endphp
            <a href="{{ route('lessons.index', array_merge(request()->query(), ['level' => $level->name, 'page' => null])) }}"
                class="btn btn-sm level-btn {{ request('level') == $level->name ? 'active-level' : '' }}"
                style="--clr: {{ $color }}; color: {{ $color }}; border: 2px solid {{ $color }};">
                {{ $level->name }}
            </a>
            @endforeach
        </div>

        <!-- Lessons Grid -->
        <div class="row g-3">
            @forelse($lessons as $lesson)
            <div class="col-6 col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body user-card d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="fw-bold">{{ $lesson->title }}</h5>
                                <p class="mb-1 text-muted small">{{ $lesson->structure }}</p>
                            </div>
                            <div>
                                @if($lesson->status == 'active')
                                <span class="badge rounded-pill p-2 bg-success">Active</span>
                                @else
                                <span class="badge rounded-pill p-2 bg-danger">Inactive</span>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-start mt-3">

                            @if($lesson->level->status == 'inactive')
                            <a href="#" class="btn btn-sm btn-primary me-2 disabled" onclick="return false;">
                                Edit
                            </a>
                            @else
                            <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-sm btn-primary me-2">
                                Edit
                            </a>
                            @endif

                            <form action="{{ route('lesson.status', $lesson->id) }}" method="POST">
                                @csrf

                                @if($lesson->status == 'active')
                                <button type="submit"
                                    class="btn btn-sm btn-danger"
                                    {{ $lesson->level->status == 'inactive' ? 'disabled onclick=return(false);' : '' }}>
                                    Inactive
                                </button>
                                @else
                                <button type="submit"
                                    class="btn btn-sm btn-success"
                                    {{ $lesson->level->status == 'inactive' ? 'disabled onclick=return(false);' : '' }}>
                                    Active
                                </button>
                                @endif
                            </form>

                        </div>

                    </div>



                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center text-muted mt-4">No lessons available.</p>
            </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-end mt-4">
            {{ $lessons->links('components.paginations') }}
        </div>

    </div>
    @endsection