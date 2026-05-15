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

    .timer-box {
        font-size: 20px;
        font-weight: bold;
        color: red;
    }
</style>

<div class="container">
    <div class="row justify-content-center">

        <h1 class="text-center" style="color: {{ $levelColor }};">
            {{ $exam->title }}
        </h1>

        <div class="text-center mb-3">
            <div class="timer-box">
                Time Remaining: <span id="timer"></span>
            </div>
        </div>

        <div class="col-md-8">
            <form id="examForm" action="{{ route('question.storeResult', $exam->id) }}" method="POST">
                @csrf
                <input type="hidden" name="time_taken" id="time_taken">
                
                @foreach($questions as $question)
                <div class="card p-3 mb-3">
                    <h5>{{ $question->question }}</h5>

                    @foreach($question->options->shuffle() as $option)
                    <div>
                        <label style="display:block; cursor:pointer; margin-bottom:10px;">
                            <input type="radio"
                                name="answers[{{ $question->id }}]"
                                value="{{ $option->id }}">
                            {{ $option->option_text }}
                        </label>
                    </div>
                    @endforeach
                </div>
                @endforeach

                <button type="submit" class="btn text-white mb-3"
                    style="background-color: {{ $levelColor }};">
                    Submit Exam
                </button>

                <a href="{{ route('showExam') }}" class="btn btn-primary mb-3">
                    Cancel
                </a>
            </form>
        </div>
    </div>
</div>

<script>
    let duration = 60;
    let display = document.getElementById('timer');
    let form = document.getElementById('examForm');
    let timeInput = document.getElementById('time_taken');

    let start = Date.now();

    setInterval(() => {

        let elapsed = Math.floor((Date.now() - start) / 1000);
        let remaining = duration - elapsed;

        // update timer display
        let m = Math.floor(remaining / 60);
        let s = remaining % 60;

        display.innerText =
            (m < 10 ? "0" + m : m) + ":" +
            (s < 10 ? "0" + s : s);

        // store time
        timeInput.value = elapsed;

        // auto submit
        if (remaining <= 0) {
            timeInput.value = duration;
            form.submit();
        }

    }, 1000);
</script>

@endsection