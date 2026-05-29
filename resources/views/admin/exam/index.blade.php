@extends('layouts.app')

@section('content')
<style>
    .user-card {
        border: 2px solid #ff7c9d;
        background-color: rgb(255, 255, 255);
        transition: all 0.2s ease;
        border-radius: 15px;
    }

    .user-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .stats-card {
        border-radius: 15px;
        border-color: #000;
        color: white;
        transition: 0.3s;
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

    <div class="position-relative mb-4">
        <a href="{{ route('admin') }}" class="pe-4 position-absolute start-0 top-0 fs-4 text-decoration-none text-body">
            <i class="fa fa-arrow-left me-2"></i> <span class="d-none d-sm-inline">Back</span>
        </a>
        <h1 class="fw-bold text-center" style="color: #ff7c9d;">Exams' List</h1>
    </div>

    <div class="row mb-4 g-3 d-flex justify-content-center">
        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('exams.index', ['status' => 'all']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Total Exams</h6>
                    <h2 class="fw-bold text-primary">{{ $totalExams }}</h2>
                </div>
            </a>
        </div>

        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('exams.index', ['status' => 'active']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Active Exams</h6>
                    <h2 class="fw-bold text-success">{{ $activeExams }}</h2>
                </div>
            </a>
        </div>

        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('exams.index', ['status' => 'inactive']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Inactive Exams</h6>
                    <h2 class="fw-bold text-danger">{{ $inactiveExams }}</h2>
                </div>
            </a>
        </div>
    </div>

    <div class="row g-3">
        @forelse($exams as $exam)
        <div class="col-6 col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body user-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="fw-bold">{{ $exam->title }}</h5>
                            <p class="mb-1">Pass mark : {{ $exam->pass_mark }}</p>
                        </div>

                        <div>
                            @if($exam->status == 'active')
                            <span class="badge rounded-pill p-2 bg-success">Active</span>
                            @else
                            <span class="badge rounded-pill p-2 bg-danger">Inactive</span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mt-3">
                        @if($exam->level->status == 'inactive')
                        <a href="#"
                            class="btn btn-sm btn-primary me-2 disabled"
                            onclick="return false;">
                            Edit
                        </a>
                        @else
                        <a href="{{ route('exams.edit', $exam->id) }}"
                            class="btn btn-sm btn-primary me-2">
                            Edit
                        </a>
                        @endif

                        <form action="{{ route('exam.status', $exam->id) }}" method="POST">
                            @csrf

                            @if($exam->status == 'active')
                            <button type="submit"
                                class="btn btn-sm btn-danger {{ $exam->level->status == 'inactive' ? 'disabled' : '' }}"
                                {{ $exam->level->status == 'inactive' ? 'disabled onclick=return(false);' : '' }}>
                                Inactive
                            </button>
                            @else
                            <button type="submit"
                                class="btn btn-sm btn-success {{ $exam->level->status == 'inactive' ? 'disabled' : '' }}"
                                {{ $exam->level->status == 'inactive' ? 'disabled onclick=return(false);' : '' }}>
                                Active
                            </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @empty
        <p class="text-center text-muted mt-4">No exams available.</p>
        @endforelse

        <div class="d-flex justify-content-end mt-4">
            {{ $exams->links('components.paginations') }}
        </div>
    </div>
</div>
</div>
@endsection