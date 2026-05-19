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
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-5 gap-2">

        <h1 class="fw-bold m-0 text-center text-md-start flex-grow-1"
            style="color: #ff7c9d;">
            Taken Exams
        </h1>

        <a href="{{ route('user') }}"
            class="btn rounded-3 text-white shadow-sm px-4 ms-auto ms-md-0"
            style="background-color: #6c757d;">
            <i class="fa fa-arrow-left me-2"></i>Back
        </a>

    </div>

    <div class="row justify-content-center">
        @foreach($attempts as $attempt)
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
        @endforeach
        <div class="d-flex justify-content-center mt-4">
            {{ $attempts->links() }}
        </div>
    </div>
</div>
</div>
@endsection