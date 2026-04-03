@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white text-center py-3 rounded-top-4">
                    <h4 class="mb-0">Edit Question</h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('questions.update', $question->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Question Text -->
                        <div class="mb-3">
                            <label class="form-label">Question</label>
                            <input type="text" name="question" class="form-control" value="{{ $question->question }}" required>
                        </div>

                        <!-- Dynamic Options -->
                        <div class="mb-3">
                            <label class="form-label">Options</label>
                            <div id="options-wrapper">
                                @foreach($question->options as $index => $option)
                                    <div class="input-group mb-2 option-item">
                                        <span class="input-group-text">
                                            <input type="radio" name="correct_option" value="{{ $index }}"
                                                {{ $option->is_correct ? 'checked' : '' }}>
                                        </span>
                                        <input type="text" name="options[]" class="form-control" value="{{ $option->option_text }}" required>
                                        <button type="button" class="btn btn-danger remove-option">X</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" id="add-option" class="btn btn-sm btn-success mt-2">
                                + Add Option
                            </button>
                        </div>

                        <!-- Exam Select -->
                        <div class="mb-3">
                            <label class="form-label">Exam</label>
                            <select name="exam_id" class="form-control" required>
                                <option value="{{ $question->exam->id }}">{{ $question->exam->title }}</option>
                                @foreach($exams as $e)
                                    @if($e->id != $question->exam->id)
                                        <option value="{{ $e->id }}">{{ $e->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary rounded-pill px-4 mt-3">Update</button>
                        <a href="{{ route('questions.index') }}" class="btn btn-danger rounded-pill px-4 mt-3">Cancel</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
let optionIndex = {{ $question->options->count() }};

document.getElementById('add-option').addEventListener('click', function () {
    let wrapper = document.getElementById('options-wrapper');

    let div = document.createElement('div');
    div.classList.add('input-group', 'mb-2', 'option-item');

    div.innerHTML = `
        <span class="input-group-text">
            <input type="radio" name="correct_option" value="${optionIndex}">
        </span>
        <input type="text" name="options[]" class="form-control" placeholder="Option ${optionIndex+1}" required>
        <button type="button" class="btn btn-danger remove-option">X</button>
    `;

    wrapper.appendChild(div);
    optionIndex++;
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-option')) {
        e.target.closest('.option-item').remove();
    }
});
</script>
@endsection