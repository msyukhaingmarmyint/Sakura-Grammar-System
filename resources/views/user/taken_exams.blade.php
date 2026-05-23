@extends('layouts.app')

@section('content')
<style>
    .exam-card {
        background-color: #fff;
        border-radius: 20px;
        transition: all .25s ease;
    }

    .exam-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
    }
</style>
<div class="container">
    <div class="text-center mb-5 position-relative">
        <a href="{{ route('user') }}" class="px-4 position-absolute start-0 top-0 fs-4 text-decoration-none text-body">
            <i class="fa fa-arrow-left me-2"></i> <span class="d-none d-sm-inline">Back</span> 
        </a>
        <h1 class="fw-bold" style="color: #ff7c9d;">Taken Exams</h1>
    </div>

    <div class="row justify-content-center">
        @forelse($attempts as $attempt)
        <div class="col-md-4 mb-3">
            <div class="card exam-card h-100 border-2 shadow-sm" style="border-color: {{ $colors[($attempt->exam_id - 1) % count($colors)] }};">
                <div class="card-body">
                    <h3 class="fw-bold" style="color: {{ $colors[($attempt->exam_id - 1) % count($colors)] }};">{{ $attempt->exam->title }}</h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-body">
                            <h5>Attempt: {{ $attempt->attempt_count }}</h5>
                        </li>

                        <li class="list-group-item bg-body">
                            <h5>Mark: {{ $attempt->mark }} ({{ $attempt->status }})</h5>
                        </li>

                        <li class="list-group-item bg-body">
                            <h5>Duration: {{gmdate('i:s', $attempt->time_taken ?? 0)}} </h5>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center text-muted mt-4">Hasn't taken any exams yet.</p>
        @endforelse
        <div class="d-flex justify-content-center mt-4">
            {{ $attempts->links() }}
        </div>
    </div>
</div>
</div>
@endsection