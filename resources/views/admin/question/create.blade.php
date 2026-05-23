<style>
    .remove-option.is-disabled {
        opacity: 0.65;
        cursor: not-allowed !important;
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
    }
</style>
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-7 col-md-9">

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-dark text-white text-center py-3 border-0">
                    <h4 class="mb-0 fw-bold">Add Question</h4>
                </div>

                <div class="card-body p-4 bg-white">
                    <form action="{{ route('questions.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">Question Text</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-dark">
                                    <i class="fa-solid fa-circle-question"></i>
                                </span>
                                <input type="text" name="question" class="form-control border-start-0 ps-2" value="{{ old('question') }}" placeholder="Enter the examination question">
                            </div>
                            @error('question')
                                <p class="text-danger small mt-1 mb-0"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-2">
                                Options (Select at least two options)
                            </label>
<div id="options-wrapper">
    @if(old('options'))
        @foreach(old('options') as $index => $optionValue)
            <div class="input-group shadow-sm rounded-3 overflow-hidden mb-2 option-item">
                <span class="input-group-text bg-light border-end-0">
                    <input type="radio" name="correct_option" value="{{ $index }}" class="form-check-input mt-0" {{ old('correct_option') == $index ? 'checked' : '' }}>
                </span>
                <input type="text" name="options[]" class="form-control border-start-0 border-end-0 ps-2 @error('options.'.$index) is-invalid @enderror" value="{{ $optionValue }}" placeholder="Option {{ $index + 1 }}">
                <button type="button" class="btn btn-danger border-start-0 px-3 remove-option">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            @error('options.'.$index)
                <p class="text-danger small mb-2 mt-n1 ms-1">{{ $message }}</p>
            @enderror
        @endforeach
    @else
        <!-- Default Initial Layout -->
        <div class="input-group shadow-sm rounded-3 overflow-hidden mb-2 option-item">
            <span class="input-group-text bg-light border-end-0">
                <input type="radio" name="correct_option" value="0" class="form-check-input mt-0" checked>
            </span>
            <input type="text" name="options[]" class="form-control border-start-0 border-end-0 ps-2" placeholder="Option 1">
            <button type="button" class="btn btn-danger border-start-0 px-3 remove-option">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div class="input-group shadow-sm rounded-3 overflow-hidden mb-2 option-item">
            <span class="input-group-text bg-light border-end-0">
                <input type="radio" name="correct_option" value="1" class="form-check-input mt-0">
            </span>
            <input type="text" name="options[]" class="form-control border-start-0 border-end-0 ps-2" placeholder="Option 2">
            <button type="button" class="btn btn-danger border-start-0 px-3 remove-option">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif
</div>

                          @error('correct_option')
                                <p class="text-danger small mt-1 mb-0">{{ $message }}</p>
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
                                <select name="exam_id" class="form-select border-start-0 ps-2">
                                    <option value="">Select Target Exam</option>
                                    @foreach($exams as $exam)
                                        <option value="{{ $exam->id }}" {{ old('exam_id') == $exam->id ? 'selected' : '' }}>
                                            {{ $exam->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('exam_id')
                                <p class="text-danger small mt-1 mb-0"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center gap-2 mt-4">
                            <button type="submit" class="btn text-white px-4 rounded-3 fw-medium shadow-sm" style="background-color: #dd4c70;">
                                Create Question
                            </button>
                            <a href="{{ route('admin') }}" class="btn btn-secondary px-4 rounded-3 fw-medium">
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
    // Dynamically get the wrapper container
    const wrapper = document.getElementById('options-wrapper');

    // Helper function to re-index all options starting from 1 up to the current total
    function reIndexOptions() {
        const items = wrapper.querySelectorAll('.option-item');
        
        items.forEach((item, idx) => {
            // Fix the radio input value
            const radio = item.querySelector('input[type="radio"]');
            if (radio) radio.value = idx;

            // Fix the text input placeholder
            const textInput = item.querySelector('input[type="text"]');
            if (textInput) textInput.placeholder = `Option ${idx + 1}`;

            // Manage the remove buttons states and native titles
            const removeBtn = item.querySelector('.remove-option');
            if (removeBtn) {
                if (items.length <= 2) {
                    removeBtn.classList.add('is-disabled');
                    removeBtn.setAttribute('title', 'At least 2 options are required');
                } else {
                    removeBtn.classList.remove('is-disabled');
                    removeBtn.removeAttribute('title');
                }
            }
        });
    }

    // Handle adding a new option
    document.getElementById('add-option').addEventListener('click', function() {
        const div = document.createElement('div');
        div.classList.add('input-group', 'shadow-sm', 'rounded-3', 'overflow-hidden', 'mb-2', 'option-item');

        div.innerHTML = `
            <span class="input-group-text bg-light border-end-0">
                <input type="radio" name="correct_option" value="0" class="form-check-input mt-0">
            </span>
            <input type="text" name="options[]" class="form-control border-start-0 border-end-0 ps-2" placeholder="Option">
            <button type="button" class="btn btn-danger border-start-0 px-3 remove-option">
                <i class="fa-solid fa-xmark"></i>
            </button>`;

        wrapper.appendChild(div);
        
        // Instantly clean up indices
        reIndexOptions();
    });

// Handle removing an option
    document.addEventListener('click', function(e) {
        const removeBtn = e.target.closest('.remove-option');
        if (removeBtn) {
            // Guard clause: stop execution if the button is locked down
            if (removeBtn.classList.contains('is-disabled')) {
                return;
            }

            const itemToDelete = removeBtn.closest('.option-item');
            const wasChecked = itemToDelete.querySelector('input[type="radio"]').checked;
            
            itemToDelete.remove();
            
            // If the deleted option was the selected correct answer, pass the selection to the first remaining row
            if (wasChecked) {
                const firstRadio = wrapper.querySelector('.form-check-input');
                if (firstRadio) firstRadio.checked = true;
            }

            // Clean up indices right after deletion
            reIndexOptions();
        }
    });

    // Initialize formatting on page load (handles old validation data correctly)
    reIndexOptions();
</script>
@endsection