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
</style>

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

    <div class="row g-3 mb-4 justify-content-center">
        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('lessons.index', ['status' => 'all']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Total Lessons</h6>
                    <h2 class="fw-bold text-primary">{{ $totalLessons }}</h2>
                </div>
            </a>
        </div>

        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('lessons.index', ['status' => 'active']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Active Lessons</h6>
                    <h2 class="fw-bold text-success">{{ $activeLessons }}</h2>
                </div>
            </a>
        </div>

        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('lessons.index', ['status' => 'inactive']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Inactive Lessons</h6>
                    <h2 class="fw-bold text-danger">{{ $inactiveLessons }}</h2>
                </div>
            </a>
        </div>

    </div>

    <div class="mb-4 d-flex justify-content-center flex-wrap gap-2">
        @foreach($levels as $index => $level)
        @php
        $color = $colors[$index % count($colors)];
        @endphp
        <a href="{{ route('lessons.index', ['level' => $level->name]) }}"
            class="btn btn-sm level-btn {{ request('level') == $level->name ? 'active-level' : '' }}"
            style="--clr: {{ $color }}; color: {{ $color }}; border: 2px solid {{ $color }};">
            {{ $level->name }}
        </a>
        @endforeach
    </div>

    <div class="row g-3">

        @forelse($lessons as $lesson)

        <div class="col-6 col-md-6 col-lg-4">

            <div class="card h-100 shadow-sm border-0">

                <div class="card-body user-card">

                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="fw-bold">{{ $lesson->title }}</h5>
                            <p class="mb-1">{{ $lesson->structure }}</p>
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
                        <a href="{{ route('lessons.edit', $lesson->id) }}"
                            class="btn btn-sm btn-primary me-2 {{$lesson->level->status == 'inactive' ? 'disabled' : ''}}">
                            Edit
                        </a>

                        <form action="{{ route('lesson.status', $lesson->id) }}" method="POST">
                            @csrf

                            @if($lesson->status == 'active')
                            <button class="btn btn-sm btn-danger {{$lesson->level->status == 'inactive' ? 'disabled' : ''}}">
                                Inactive
                            </button>
                            @else
                            <button class="btn btn-sm btn-success {{$lesson->level->status == 'inactive' ? 'disabled' : ''}}">
                                Active
                            </button>
                            @endif

                        </form>

                    </div>

                </div>
            </div>

        </div>

        @empty
        <p class="text-center text-muted mt-4">No lessons available.</p>
        @endforelse

    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $lessons->links() }}
    </div>

</div>
@endsection