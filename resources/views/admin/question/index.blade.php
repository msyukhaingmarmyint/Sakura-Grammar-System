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
    <div class="position-relative mb-4">
        <a href="{{ route('admin') }}" class="px-4 position-absolute start-0 top-0 fs-4 text-decoration-none text-body">
            <i class="fa fa-arrow-left me-2"></i> <span class="d-none d-sm-inline">Back</span> 
        </a>
        <h1 class="fw-bold text-center" style="color: #ff7c9d;">Questions' List</h1>
    </div>

    <div class="row mb-4 g-3 d-flex justify-content-center">
        <div class="col-md-2">
            <a href="{{ route('questions.index', ['status' => 'all']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Total Questions</h6>
                    <h2 class="fw-bold text-primary">{{ $totalQuestions }}</h2>
                </div>
            </a>
        </div>

        <div class="col-md-2">
            <a href="{{ route('questions.index', ['status' => 'active']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Active Questions</h6>
                    <h2 class="fw-bold text-success">{{ $activeQuestions }}</h2>
                </div>
            </a>
        </div>

        <div class="col-md-2">
            <a href="{{ route('questions.index', ['status' => 'inactive']) }}" class="text-decoration-none">
                <div class="card stats-card text-center p-3 shadow-sm">
                    <h6 class="text-body">Inactive Questions</h6>
                    <h2 class="fw-bold text-danger">{{ $inactiveQuestions }}</h2>
                </div>
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="row g-3">
            @forelse($questions as $question)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body user-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="fw-bold">{{ $question->question }}</h5>
                            </div>

                            <div>
                                @if($question->status == 'active')
                                <span class="badge rounded-pill p-2 bg-success">Active</span>
                                @else
                                <span class="badge rounded-pill p-2 bg-danger">Inactive</span>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex justify-content-start mt-3">
                            <a href="{{route('questions.edit',$question->id)}}" class="btn btn-sm btn-primary me-2">
                                Edit
                            </a>
                            <form action="{{route('question.status',$question->id)}}" method="POST">
                                @csrf
                                @if($question->status == 'active')
                                <button class="btn btn-sm btn-danger">
                                    Inactive
                                </button>
                                @else
                                 <button class="btn btn-sm btn-success ">
                                    Active
                                </button>
                                @endif
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            @empty 
            <p class="text-center text-muted mt-4">No questions available.</p> 
            @endforelse
            <div class="d-flex justify-content-center mt-4">
                {{ $questions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection