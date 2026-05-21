@extends('layouts.app')

@section('content')

<style>
    /* Premium Exam Card Styling */
    .exam-card {
        border-radius: 16px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .exam-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    /* Custom clickable option row design */
    .option-wrapper {
        display: block;
        cursor: pointer;
        padding: 12px 16px;
        margin-bottom: 10px;
        border: 1px solid var(--bs-border-color);
        border-radius: 10px;
        transition: background-color 0.15s ease, border-color 0.15s ease;
    }

    /* Subtle hover indicator highlight */
    .option-wrapper:hover {
        background-color: var(--bs-tertiary-bg);
        border-color: var(--bs-border-color-translucent);
    }

    /* Native radio positioning alignment adjustment */
    .option-wrapper input[type="radio"] {
        margin-right: 10px;
        transform: scale(1.1);
        vertical-align: middle;
    }

    /* Standout glowing badge styling for your active countdown timer */
    .timer-badge {
        font-family: 'Courier New', Courier, monospace;
        letter-spacing: 1px;
        font-size: 1.25rem;
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <h1 class="text-center fw-bold mb-2" style="color: {{ $levelColor }};">
                {{ $exam->title }}
            </h1>

            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center gap-2 bg-danger-subtle text-danger px-4 py-2 rounded-pill shadow-sm">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <span class="fw-bold text-uppercase small tracking-wider">Time Remaining:</span>
                    <span id="timer" class="fw-bold timer-badge">00:00</span>
                </div>
            </div>

            <form id="examForm" action="{{ route('question.storeResult', $exam->id) }}" method="POST">
                @csrf
                <input type="hidden" name="time_taken" id="time_taken">
                
                @foreach($questions as $question)
                <div class="card exam-card bg-body-tertiary border-0 shadow-sm p-4 mb-4">
                    <h5 class="fw-bold text-body mb-3">
                        <span class="text-muted small me-1">#{{ $loop->iteration }}</span> 
                        {{ $question->question }}
                    </h5>

                    <div class="options-container">
                        @foreach($question->options->shuffle() as $option)
                        <label class="option-wrapper text-body">
                            <input type="radio" 
                                   class="form-check-input mt-0"
                                   name="answers[{{ $question->id }}]" 
                                   value="{{ $option->id }}">
                            <span class="ms-1 align-middle">{{ $option->option_text }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach

                <div class="d-flex align-items-center justify-content-start gap-2 pt-2 mb-5">
                    <button type="submit" class="btn text-white px-4 py-2 rounded-3 fw-medium shadow-sm"
                        style="background-color: {{ $levelColor }};">
                        Submit Exam
                    </button>

                    <a href="{{ route('showExam') }}" class="btn btn-secondary px-4 py-2 rounded-3 fw-medium">
                        Cancel
                    </a>
                </div>
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

    let timerInterval = setInterval(() => {
        let elapsed = Math.floor((Date.now() - start) / 1000);
        let remaining = duration - elapsed;

        // Prevent counter from displaying negative figures near execution cut-off
        if (remaining < 0) remaining = 0;

        // update timer display string layout calculation
        let m = Math.floor(remaining / 60);
        let s = remaining % 60;

        display.innerText =
            (m < 10 ? "0" + m : m) + ":" +
            (s < 10 ? "0" + s : s);

        // store actual operational tracking timeline
        timeInput.value = elapsed;

        // absolute fallback auto submit execution trigger
        if (remaining <= 0) {
            clearInterval(timerInterval);
            timeInput.value = duration;
            form.submit();
        }
    }, 1000);
</script>

@endsection