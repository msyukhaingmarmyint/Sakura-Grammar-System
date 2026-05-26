@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8">

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-dark text-white text-center py-3 border-0">
                    <h4 class="mb-0 fw-bold">Add Level</h4>
                </div>

                <div class="card-body p-4 bg-white">
                    <form action="{{ route('levels.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">Name</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-dark">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <input type="text" name="name" class="form-control border-start-0 ps-2" value="{{ old('name') }}" placeholder="e.g. N4">
                            </div>
                            @error('name')
                                <p class="text-danger small mt-1 mb-0"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
    <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">
        Description
    </label>

    <div class="shadow-sm rounded-3 overflow-hidden border">
        <div class="bg-light px-3 py-2 border-bottom">
            <i class="fa-solid fa-align-left text-dark"></i>
        </div>

        <textarea
            name="description"
            id="description"
            class="form-control border-0 rounded-0"
            rows="4"
            maxlength="255"
            placeholder="Brief description of this proficiency tier">{{ old('description') }}</textarea>
    </div>

    <div class="text-end mt-1">
        <small id="charCount" class="text-muted">
            {{ strlen(old('description', '')) }} / 255
        </small>
    </div>

    @error('description')
        <p class="text-danger small mt-1 mb-0">{{ $message }}</p>
    @enderror
</div>

                        <div class="d-flex justify-content-center gap-2 mt-4">
                            <button type="submit" class="btn text-white px-4 rounded-3 fw-medium shadow-sm" style="background-color: #dd4c70;">
                                Create Level
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
    const textarea = document.getElementById('description');
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