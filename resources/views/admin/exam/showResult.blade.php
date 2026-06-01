@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white" style="background-color: #ff7c9d;">
                    <h3 class="text-center">{{ $exam->title }} - Result</h3>
                </div>

                <div class="card-body text-center bg-white">
                    <h2 class="fw-bold mb-4" style="color: #ff7c9d;">{{ $attempt->mark }} / 50</h2>
                    <h5 class="fw-bold mb-4">Pass mark : {{$exam->pass_mark}}</h5>

                    <div class="row mb-4">
                        <div class="col-md-3">
                            <h4>Total Questions</h4>
                            <h5>{{ $attempt->total_questions }}</h5>
                        </div>

                        <div class="col-md-3">
                            <h4>Correct Answers</h4>
                            <h5>{{ $attempt->correct_answers }}</h5>
                        </div>

                        <div class="col-md-3">
                            <h4>Duration</h4>
                            <h5>{{gmdate('i:s', $attempt->time_taken ?? 0)}}</h5>
                        </div>

                        <div class="col-md-3">
                            <h4>Status</h4>
                            <h5 class="fw-bold {{$attempt->status == 'pass' ? 'text-success' : 'text-danger'}}">{{ ucfirst($attempt->status) }}</h5>
                        </div>
                    </div>
<div class="d-flex flex-wrap justify-content-center gap-2 mt-4">
                        @if($totalAttempts < 3)
                            <a href="{{ route('question.showByExam', $exam->id) }}" class="btn action-btn btn-outline-primary px-4 py-2 rounded-pill fw-bold">
                                <i class="fa fa-redo me-2 small"></i> Retake Exam ({{ 3 - $totalAttempts }} left)
                            </a>
                        @endif

                        @if($attempt->status == 'pass')
                            <a href="{{ route('user.getCertificate', $attempt->id) }}" class="btn action-btn btn-success px-4 py-2 rounded-pill fw-bold text-white shadow-sm">
                                <i class="fa fa-award me-2"></i> Get Certificate
                            </a>
                        @else
                            <button class="btn btn-secondary px-4 py-2 rounded-pill fw-bold opacity-70" disabled style="cursor: not-allowed;">
                                <i class="fa fa-lock me-2 small"></i> Pass to Unlock Certificate
                            </button>
                        @endif

                        <a href="{{ route('exam.review', $attempt->id) }}" class="btn action-btn btn-info px-4 py-2 rounded-pill fw-bold text-white shadow-sm">
                            <i class="fa fa-search me-2 small"></i> Review Answers
                        </a>

                        <a href="{{ route('showExam') }}" class="btn action-btn btn-light border px-4 py-2 rounded-pill fw-bold text-secondary">
                            Back to Exams
                        </a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection