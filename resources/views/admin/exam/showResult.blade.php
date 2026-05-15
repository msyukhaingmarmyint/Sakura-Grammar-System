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

                    @if($totalAttempts < 3)
                        <a href="{{ route('question.showByExam', $exam->id) }}" class="btn btn-primary me-2">
                        Retake Exam ({{ 3 - $totalAttempts }} attempts left)
                        </a>
                        @endif

                        @if($attempt->status == 'pass')
                        <a href="{{ route('user.getCertificate', $attempt->id) }}" class="btn btn-success">Get Certificate</a>
                        @else
                        <button class="btn btn-success" disabled>Pass Exam to Get Certificate</button>
                        @endif

                        <a href="{{ route('showExam') }}" class="btn btn-secondary">Back to Exams</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection