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

    [data-bs-theme="dark"] .d-flex p, .d-flex small {
            color: #000 !important;
    }

    [data-bs-theme="dark"] .stats-card {
            border-color: #fff !important;
    }
</style>

<div class="container">
    <div class="position-relative mb-3">
        <h1 class="fw-bold text-center" style="color: #ff7c9d;">Lessons' List</h1>
        <a href="{{ route('admin') }}" class="btn px-4 position-absolute end-0 top-0 rounded-3 text-white shadow-sm" style="background-color: #6c757d;">
            <i class="fa fa-arrow-left me-2"></i>Back
        </a>
        </div>

    <div class="row mb-4 g-3 d-flex justify-content-center">
        <div class="col-md-2">
            <a href="{{ route('lessons.index', ['status' => 'all']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Total Lessons</h6>
                    <h2 class="fw-bold text-primary">{{ $totalLessons }}</h2>
                </div>
            </a>
        </div>

        <div class="col-md-2">
            <a href="{{ route('lessons.index', ['status' => 'active']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Active lessons</h6>
                    <h2 class="fw-bold text-success">{{ $activeLessons }}</h2>
                </div>
            </a>
        </div>

        <div class="col-md-2">
            <a href="{{ route('lessons.index', ['status' => 'inactive']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Inactive lessons</h6>
                    <h2 class="fw-bold text-danger">{{ $inactiveLessons }}</h2>
                </div>
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="row g-3">
            @forelse($lessons as $lesson)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body user-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="fw-bold">{{ $lesson->title }}</h5>
                                <p class="text-muted mb-1">{{ $lesson->structure }}</p>
                                <small class="text-secondary">Lesson ID : {{ $lesson->id }}</small>
                            </div>

                            <div>
                                @if($lesson->status == 'active')
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-danger">Inactive</span>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-end">
                            <a href="{{route('lessons.edit',$lesson->id)}}" class="btn btn-sm btn-primary rounded-pill me-2">
                                Edit
                            </a>
                            <form action="{{route('lesson.status',$lesson->id)}}" method="POST">
                                @csrf
                                @if($lesson->status == 'active')
                                <button class="btn btn-sm btn-danger rounded-pill">
                                    Deactivate
                                </button>
                                @else
                                 <button class="btn btn-sm btn-success rounded-pill">
                                    Activate
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
            <div class="d-flex justify-content-center mt-4">
                {{ $lessons->links() }}
            </div>
        </div>
    </div>
</div>
@endsection