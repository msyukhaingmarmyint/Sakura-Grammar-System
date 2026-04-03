@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white text-center py-3 rounded-top-4">
                    <h4 class="mb-0">Add Question</h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('questions.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label>Question</label>
                            <input type="text" name="question" value="{{old('question')}}" class="form-control" >

                            @error('question')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Options</label>

                            <div id="options-wrapper">
                                <div class="input-group mb-2 option-item">
                                    <span class="input-group-text">
                                        <input type="radio" name="correct_option" value="0" checked>
                                    </span>
                                    <input type="text" name="options[]" class="form-control" placeholder="Option 1">
                                    <button type="button" class="btn btn-danger remove-option">X</button>
                                </div>

                                <div class="input-group mb-2 option-item">
                                    <span class="input-group-text">
                                        <input type="radio" name="correct_option" value="1">
                                    </span>
                                    <input type="text" name="options[]" class="form-control" placeholder="Option 2">
                                    <button type="button" class="btn btn-danger remove-option">X</button>
                                </div>

                                @error('options.*')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <button type="button" id="add-option" class="btn btn-sm btn-primary mt-2">
                                + Add Option
                            </button>
                        </div>

                        <div class="mb-3">
                            <label>Exam</label>
                            <select name="exam_id" class="form-control">
                                <option value="">Select Exam</option>
                                @foreach($exams as $exam)
                                <option value="{{ $exam->id }}">{{ $exam->title }}</option>
                                @endforeach
                            </select>
                            @error('exam_id')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary rounded-pill px-4">Create</button>
                        <a href="{{route('admin')}}" class="btn btn-danger rounded-pill px-4">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let optionIndex = 2; 

    document.getElementById('add-option').addEventListener('click', function() {
        let wrapper = document.getElementById('options-wrapper');

        let div = document.createElement('div');
        div.classList.add('input-group', 'mb-2', 'option-item');

        div.innerHTML = `<span class="input-group-text">
            <input type="radio" name="correct_option" value="${optionIndex}">
        </span>
        <input type="text" name="options[]" class="form-control" placeholder="Option ${optionIndex + 1}" required>
        <button type="button" class="btn btn-danger remove-option">X</button>`;

        wrapper.appendChild(div);
        optionIndex++;
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-option')) {
            e.target.closest('.option-item').remove();
        }
    });
</script>
@endsection