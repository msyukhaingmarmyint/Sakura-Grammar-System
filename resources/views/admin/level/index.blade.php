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
           class="pe-4 position-absolute start-0 top-0 fs-4 text-decoration-none text-body">
            <i class="fa fa-arrow-left me-2"></i>
            <span class="d-none d-sm-inline">Back</span>
        </a>

        <h1 class="fw-bold text-center" style="color: #ff7c9d;">
            Levels' List
        </h1>
    </div>

    <div class="row g-3 mb-4 justify-content-center">
        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('levels.index', ['status' => 'all']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Total Levels</h6>
                    <h2 class="fw-bold text-primary">{{ $totalLevels }}</h2>
                </div>
            </a>
        </div>

        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('levels.index', ['status' => 'active']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Active Levels</h6>
                    <h2 class="fw-bold text-success">{{ $activeLevels }}</h2>
                </div>
            </a>
        </div>

        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('levels.index', ['status' => 'inactive']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Inactive Levels</h6>
                    <h2 class="fw-bold text-danger">{{ $inactiveLevels }}</h2>
                </div>
            </a>
        </div>
    </div>

    <div class="row g-3">
        @forelse($levels as $level)
            <div class="col-6 col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body user-card d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="fw-bold">{{ $level->name }}</h5>
                                <p class="mb-1">
                                    Description: {{ $level->description }}
                                </p>
                            </div>

                            <div>
                                @if($level->status == 'active')
                                    <span class="badge rounded-pill p-2 bg-success">Active</span>
                                @else
                                    <span class="badge rounded-pill p-2 bg-danger">Inactive</span>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex justify-content-start mt-auto pt-3">
                            <a href="{{ route('levels.edit', $level->id) }}"class="btn btn-sm btn-primary me-2">Edit</a>

                            <form action="{{ route('level.status', $level->id) }}" method="POST">
                                @csrf
                                @if($level->status == 'active')
                                    <button class="btn btn-sm btn-danger">
                                        Inactive
                                    </button>
                                @else
                                    <button class="btn btn-sm btn-success">
                                        Active
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted mt-4">No levels available.</p>
        @endforelse
    </div>

    <div class="d-flex justify-content-end mt-4">
        {{ $levels->links('components.paginations') }}
    </div>
</div>
@endsection