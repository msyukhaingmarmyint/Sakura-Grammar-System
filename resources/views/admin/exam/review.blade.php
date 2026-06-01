@extends('layouts.app')

@section('content')
<style>
    /* Premium Exam Card Styling Matching Active Quiz Mode */
    .exam-card {
        border-radius: 16px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    /* Option item row block structure - Variable-driven backgrounds for theme compatibility */
    .option-wrapper {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        margin-bottom: 10px;
        border: 1px solid var(--bs-border-color);
        border-radius: 10px;
        font-size: 0.95rem;
        background-color: var(--bs-body-bg);
        color: var(--bs-body-color);
    }

    /* Radio button alignments layout */
    .option-wrapper input[type="radio"] {
        margin-right: 10px;
        transform: scale(1.1);
        vertical-align: middle;
    }

    /* Dynamic, high-contrast states calibrated for both light and dark mode eyes */
    .option-correct {
        background-color: rgba(25, 135, 84, 0.15) !important;
        border-color: #198754 !important;
        color: #198754 !important;
    }

    .option-incorrect {
        background-color: rgba(220, 53, 69, 0.15) !important;
        border-color: #dc3545 !important;
        color: #dc3545 !important;
    }

    /* Dim unselected options gently while preserving theme text styles */
    .option-unselected {
        color: var(--bs-secondary-color) !important;
        opacity: 0.65;
    }

    .font-mono {
        font-family: 'Courier New', Courier, monospace;
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="position-relative mb-4 text-center">
                
                <a href="{{ url()->previous() }}" class="pe-4 position-absolute start-0 top-0 fs-4 text-decoration-none text-body">
            <i class="fa fa-arrow-left me-2"></i> <span class="d-none d-sm-inline">Back</span>
        </a>
                <h1 class="fw-bold m-0" style="color: {{ $levelColor }};">
                    {{ $exam->title }} - Review
                </h1>
            </div>

            <div class="text-center mb-5">
                <div class="d-inline-flex align-items-center gap-2 bg-body-tertiary px-4 py-2.5 rounded-pill shadow-sm border border-secondary-subtle">
                    <i class="fa-solid fa-square-poll-vertical" style="color: {{ $levelColor }};"></i>
                    <span class="text-secondary fw-bold text-uppercase small tracking-wider">Your Score:</span>
                    <span class="fw-bold fs-5 text-body font-mono">{{ $attempt->mark }} / 50</span>
                    <span class="badge rounded-pill ms-2 {{ $attempt->status == 'pass' ? 'bg-success' : 'bg-danger' }}">
                        {{ ucfirst($attempt->status) }}
                    </span>
                </div>
            </div>

            @foreach($questions as $index => $question)
            @php
                $choices = $attempt->user_choices;
                if (is_string($choices)) {
                    $choices = json_decode($choices, true);
                }
                $choices = $choices ?? [];

                $userPickedOptionId = null;
                foreach ($choices as $qId => $oId) {
                    if ((string)$qId === (string)$question->id) {
                        $userPickedOptionId = $oId;
                        break;
                    }
                }
            @endphp
            <div class="card exam-card bg-body-tertiary border-0 shadow-sm p-4 mb-4">
                
                <h5 class="fw-bold text-body mb-3">
                    <span class="text-secondary small me-1">#{{ $index + 1 }}</span> 
                    {{ $question->question }}
                </h5>

                <div class="options-container">
                    @foreach($question->options->shuffle($attempt->id) as $option)
                        @php
                            $isCorrect = (bool)$option->is_correct;
                            
                            $wasSelectedByUser = ($userPickedOptionId !== null && (string)$userPickedOptionId === (string)$option->id);
                            
                            if ($isCorrect) {
                                $contextClass = 'option-correct fw-semibold';
                            } elseif ($wasSelectedByUser && !$isCorrect) {
                                $contextClass = 'option-incorrect fw-semibold';
                            } else {
                                $contextClass = 'option-unselected';
                            }
                        @endphp

                        <div class="option-wrapper {{ $contextClass }}">
                            <input type="radio" 
                                   class="form-check-input mt-0 shadow-none" 
                                   disabled 
                                   {{ $wasSelectedByUser ? 'checked' : '' }}>
                            
                            <span class="ms-1 align-middle flex-grow-1">{{ $option->option_text }}</span>

                            @if($isCorrect)
                                <span class="badge bg-success rounded-pill px-2.5 py-1 text-white small ms-2">
                                    <i class="fa fa-check me-1"></i> Correct Answer
                                </span>
                            @endif

                            @if($wasSelectedByUser && !$isCorrect)
                                <span class="badge bg-danger rounded-pill px-2.5 py-1 text-white small ms-2">
                                    <i class="fa fa-times me-1"></i> Your Choice
                                </span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            @endforeach

            <div class="d-flex align-items-center justify-content-start gap-2 pt-2 mb-5">
                <a href="{{ route('showExam') }}" class="btn text-white px-4 py-2 rounded-3 fw-medium shadow-sm"
                    style="background-color: {{ $levelColor }};">
                    Return to Exams
                </a>
            </div>

        </div>
    </div>
</div>
@endsection