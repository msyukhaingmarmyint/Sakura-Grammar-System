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

    .progress-bar {
        transition: width .4s ease;
    }
</style>
<div class="container py-4">

    <div class="row g-4 justify-content-center">

        @foreach($exams as $index => $exam)
        <div class="col-md-6 col-lg-4">

            <div class="card exam-card h-100 border-2 shadow-sm" style="border-color: {{ $colors[$index % count($colors)] }};">

                <div class="card-body d-flex flex-column">

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="fw-bold mb-0" style="color: {{ $colors[$index % count($colors)] }}">{{ $exam->title }}</h4>
                    </div>

                    @auth
                    @php
                    $userAttempts = App\Models\Attempt::where('user_id', Auth::id())
                    ->where('exam_id', $exam->id)
                    ->count();

                    $progress = ($userAttempts / 3) * 100;
                    @endphp

                    {{-- Attempt badge --}}
                    <div class="mb-2">
                        <span class="badge {{ $userAttempts >=3 ? 'bg-danger' : 'bg-primary' }}">
                            Attempts {{ $userAttempts }}/3
                        </span>
                    </div>

                    {{-- Progress bar --}}
                    <div class="progress mb-3" style="height:6px;">
                        <div class="progress-bar 
                                {{ $userAttempts >=3 ? 'bg-danger' : 'bg-primary' }}"
                            style="width: {{ $progress }}%">
                        </div>
                    </div>

                  @if($exam->status == 'inactive' || $exam->questions_count < 5)
    <button class="btn btn-secondary border mt-auto" disabled>
       Sorry! Not available now.
    </button>


                    @elseif($userAttempts >= 3)

                    <button class="btn btn-secondary border mt-auto" disabled>
                        No Attempts Left
                    </button>

                    @else

                    <a href="{{ route('question.showByExam', $exam->id) }}"
                        class="btn mt-auto fs-5" style="background-color: {{ $colors[$index % count($colors)] }}; color: #fff;">
                        Start Exam
                    </a>

                    @endif

                    @endauth

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection