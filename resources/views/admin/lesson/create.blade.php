@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-7 col-md-9">

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-dark text-white text-center py-3 border-0">
                    <h4 class="mb-0 fw-bold">Add New Lesson</h4>
                </div>

                <div class="card-body p-4 bg-white">
                    <form action="{{ route('lessons.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">Lesson Title</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-dark">
                                    <i class="fa-solid fa-book-open"></i>
                                </span>
                                <input type="text" name="title" class="form-control border-start-0 ps-2" value="{{ old('title') }}" placeholder="e.g. Using ~てください">
                            </div>
                            @error('title')
                                <p class="text-danger small mt-1 mb-0"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">Structure / Pattern</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-dark">
                                    <i class="fa-solid fa-code-branch fa-lg"></i>
                                </span>
                                <input type="text" name="structure" class="form-control border-start-0 ps-2" value="{{ old('structure') }}" placeholder="e.g. Verb [Te-Form] + ください">
                            </div>
                            @error('structure')
                                <p class="text-danger small mt-1 mb-0"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
    <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">
        Explanation
    </label>

    <div class="shadow-sm rounded-3 overflow-hidden border">
        <div class="bg-light px-3 py-2 border-bottom">
            <i class="fa-solid fa-circle-info text-dark"></i>
        </div>

        <textarea
            id="explanation"
            name="explanation"
            class="form-control border-0 rounded-0"
            rows="4"
            maxlength="255"
            placeholder="Used when making a polite request...">{{ old('explanation') }}</textarea>
    </div>
    <div class="text-end mt-1">
        <small id="charCount" class="text-muted">0 / 255</small>
    </div>

    @error('explanation')
        <p class="text-danger small mt-1 mb-0">{{ $message }}</p>
    @enderror
</div>

                        <div class="mb-3">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">Example Sentence</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-dark">
                                    <i class="fa-solid fa-quote-left fa-lg"></i>
                                </span>
                                <input type="text" name="example" class="form-control border-start-0 ps-2" value="{{ old('example') }}" placeholder="e.g. 日本語を教えてください。">
                            </div>
                            @error('example')
                                <p class="text-danger small mt-1 mb-0"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">Proficiency Level</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-dark">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <select name="level_id" class="form-select border-start-0 ps-2">
                                    <option value="">--- Select Level ---</option>
                                    @foreach($levels as $l)
                                        <option value="{{ $l->id }}" {{ (string) old('level_id') === (string) $l->id ? 'selected' : '' }}>
                                            {{ $l->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('level_id')
                                <p class="text-danger small mt-1 mb-0"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center gap-2 mt-4">
                            <button type="submit" class="btn text-white px-4 rounded-3 fw-medium shadow-sm" style="background-color: #dd4c70;">
                                Create Lesson
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
document.addEventListener('DOMContentLoaded', function () {
    const textarea = document.getElementById('explanation');
    const counter = document.getElementById('charCount');
    const maxLength = 255;

    function updateCounter() {
        const length = textarea.value.length;
        counter.textContent = `${length} / ${maxLength}`;

        if (length > 220) {
            counter.classList.add('text-danger');
            counter.classList.remove('text-muted');
        } else {
            counter.classList.add('text-muted');
            counter.classList.remove('text-danger');
        }
    }

    updateCounter();
    textarea.addEventListener('input', updateCounter);
});
</script>
@endsection