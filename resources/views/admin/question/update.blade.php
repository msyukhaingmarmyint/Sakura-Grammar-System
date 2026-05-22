@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-7 col-md-9">

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-dark text-white text-center py-3 border-0">
                    <h4 class="mb-0 fw-bold">Edit Question</h4>
                </div>

                <div class="card-body p-4 bg-white">
                    <form action="{{ route('questions.update', $question->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">Question Text</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-dark">
                                    <i class="fa-solid fa-circle-question"></i>
                                </span>
                                <input type="text" name="question" class="form-control border-start-0 ps-2" value="{{ old('question', $question->question) }}" required>
                            </div>
                            @error('question')
                                <p class="text-danger small mt-1 mb-0">
                                     {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-2">
                                 Options (Select the Radio for Correct Answer)
                            </label>

                            <div id="options-wrapper">
                                @foreach($question->options as $index => $option)
                                    <div class="input-group shadow-sm rounded-3 overflow-hidden mb-2 option-item">
                                        <span class="input-group-text bg-light border-end-0">
                                            <input type="radio" name="correct_option" value="{{ $index }}" class="form-check-input mt-0" {{ $option->is_correct ? 'checked' : '' }}>
                                        </span>
                                        <input type="text" name="options[]" class="form-control border-start-0 border-end-0 ps-2" value="{{ $option->option_text }}" required>
                                        <button type="button" class="btn btn-danger border-start-0 px-3 remove-option">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                            @error('options.*')
                                <p class="text-danger small mt-1 mb-0">
                                     {{ $message }}</p>
                            @enderror

                            <button type="button" id="add-option" class="btn btn-sm btn-dark rounded-2 px-3 mt-2 shadow-sm">
                                <i class="fa-solid fa-plus me-1 small"></i> Add Option
                            </button>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">Assign to Exam</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-dark">
                                    <i class="fa-solid fa-file-signature"></i>
                                </span>
                                <select name="exam_id" class="form-select border-start-0 ps-2" required>
                                    <option value="{{ $question->exam->id }}">{{ $question->exam->title }}</option>
                                    @foreach($exams as $e)
                                        @if($e->id != $question->exam->id)
                                            <option value="{{ $e->id }}" {{ old('exam_id') == $e->id ? 'selected' : '' }}>
                                                {{ $e->title }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @error('exam_id')
                                <p class="text-danger small mt-1 mb-0">
                                     {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center gap-2 mt-4">
                            <button type="submit" class="btn text-white px-4 rounded-3 fw-medium shadow-sm" style="background-color: #dd4c70;">
                                Update Question
                            </button>
                            <a href="{{ route('questions.index') }}" class="btn btn-secondary px-4 rounded-3 fw-medium">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    let optionIndex = {{ $question->options->count() }};

    // Dynamic Option Appending handler injection 
    document.getElementById('add-option').addEventListener('click', function() {
        let wrapper = document.getElementById('options-wrapper');

        let div = document.createElement('div');
        div.classList.add('input-group', 'shadow-sm', 'rounded-3', 'overflow-hidden', 'mb-2', 'option-item');

        // Rendered markup rewritten to perfectly match design tokens
        div.innerHTML = `
            <span class="input-group-text bg-light border-end-0">
                <input type="radio" name="correct_option" value="${optionIndex}" class="form-check-input mt-0">
            </span>
            <input type="text" name="options[]" class="form-control bg-light border-start-0 border-end-0 ps-2" placeholder="Option ${optionIndex + 1}" required>
            <button type="button" class="btn btn-outline-danger border-start-0 px-3 remove-option">
                <i class="fa-solid fa-xmark"></i>
            </button>`;

        wrapper.appendChild(div);
        optionIndex++;
    });

    // Delegated safe item exclusion logic clean context mapping
    document.addEventListener('click', function(e) {
        let removeBtn = e.target.closest('.remove-option');
        if (removeBtn) {
            removeBtn.closest('.option-item').remove();
        }
    });
</script>
@endsection