@extends('layouts.app')

@section('content')
<style>
    /* Premium Exam Card Styling Matching Active Quiz Mode */
    .exam-card {
        border-radius: 20px;
        transition: all .25s ease;
    }

    .exam-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    /* Standardizes action link buttons to smoothly transition colors */
    .review-btn {
        transition: all 0.2s ease-in-out;
    }
    .review-btn:hover {
        opacity: 0.9;
        transform: scale(1.02);
    }

    .font-mono {
        font-family: 'Courier New', Courier, monospace;
    }
</style>

<div class="container py-4">
    <div class="text-center mb-5 position-relative">
       
         <a href="{{ route('user') }}"
            class="pe-4 position-absolute start-0 top-0 fs-4 text-decoration-none text-body">
            <i class="fa fa-arrow-left me-2"></i>
            <span class="d-none d-sm-inline">Back</span>
        </a>
        <h1 class="fw-bold" style="color: #ff7c9d;">Taken Exams</h1>
    </div>

    <div class="row justify-content-center g-4">
        @forelse($attempts as $attempt)
        @php
            $themeColor = $colors[($attempt->exam_id - 1) % count($colors)];
        @endphp
        <div class="col-md-6 col-lg-4">
            <div class="card exam-card bg-body-tertiary h-100 border-2 shadow-sm d-flex flex-column justify-content-between" style="border-color: {{ $themeColor }};">
                <div class="card-body pb-0">
                    <h3 class="fw-bold mb-3" style="color: {{ $themeColor }};">{{ $attempt->exam->title }}</h3>
                    
                    <ul class="list-group list-group-flush border-0">
                        <li class="list-group-item bg-transparent px-0 py-2 border-secondary-subtle d-flex justify-content-between align-items-center">
                            <span class="text-secondary fw-medium">Attempt Sequence</span>
                            <span class="badge bg-body text-body border border-secondary-subtle fw-bold px-2.5 py-1.5 rounded-pill">#{{ $attempt->attempt_count }}</span>
                        </li>

                        <li class="list-group-item bg-transparent px-0 py-2 border-secondary-subtle d-flex justify-content-between align-items-center">
                            <span class="text-secondary fw-medium">Earned Score</span>
                            <span class="fw-bold fs-5 text-body font-mono">{{ $attempt->mark }} / 50</span>
                        </li>

                        <li class="list-group-item bg-transparent px-0 py-2 border-secondary-subtle d-flex justify-content-between align-items-center">
                            <span class="text-secondary fw-medium">Exam Outcome</span>
                            <span class="badge fw-bold px-3 py-1.5 rounded-pill {{ $attempt->status == 'pass' ? 'bg-success text-white' : 'bg-danger text-white' }}">
                                {{ ucfirst($attempt->status) }}
                            </span>
                        </li>

                        <li class="list-group-item bg-transparent px-0 py-2 border-0 d-flex justify-content-between align-items-center">
                            <span class="text-secondary fw-medium">Duration Clock</span>
                            <span class="font-mono text-body fw-semibold">
                                <i class="far fa-clock me-1 opacity-50"></i>{{ gmdate('i:s', $attempt->time_taken ?? 0) }}
                            </span>
                        </li>
                    </ul>
                </div>

                <div class="card-footer bg-transparent border-0 pt-0 pb-4 px-4 text-center">
                    <a href="{{ route('exam.review', $attempt->id) }}" 
                       class="btn review-btn text-white w-100 py-2 rounded-pill fw-bold border-0 shadow-sm"
                       style="background-color: {{ $themeColor }};">
                        <i class="fa fa-search me-2 small"></i> Review Answers
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="text-secondary mb-3 opacity-25">
                <i class="fa fa-folder-open display-2"></i>
            </div>
            <p class="text-secondary fs-5">You haven't completed any exams yet.</p>
        </div>
        @endforelse

        <div class="d-flex justify-content-center mt-5">
            {{ $attempts->links('components.paginations') }}
        </div>
    </div>
</div>
@endsection