@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-7 col-md-9">

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-dark text-white text-center py-3 border-0">
                    <h4 class="mb-0 fw-bold">Edit Lesson</h4>
                </div>

                <div class="card-body p-4 bg-white">
                    <form action="{{ route('lessons.update', $lesson->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">Title</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-dark">
                                    <i class="fa-solid fa-book-open"></i>
                                </span>
                                <input type="text" name="title" class="form-control border-start-0 ps-2" value="{{ old('title', $lesson->title) }}">
                            </div>
                            @error('title')
                                <p class="text-danger small mt-1 mb-0"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">Structure</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-dark">
                                    <i class="fa-solid fa-code-branch fa-lg"></i>
                                </span>
                                <input type="text" name="structure" class="form-control border-start-0 ps-2" value="{{ old('structure', $lesson->structure) }}">
                            </div>
                            @error('structure')
                                <p class="text-danger small mt-1 mb-0"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">Explanation</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-dark">
                                    <i class="fa-solid fa-circle-info"></i>
                                </span>
                                <input type="text" name="explanation" class="form-control border-start-0 ps-2" value="{{ old('explanation', $lesson->explanation) }}">
                            </div>
                            @error('explanation')
                                <p class="text-danger small mt-1 mb-0"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">Example</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-dark">
                                    <i class="fa-solid fa-quote-left fa-lg"></i>
                                </span>
                                <input type="text" name="example" class="form-control border-start-0 ps-2" value="{{ old('example', $lesson->example) }}">
                            </div>
                            @error('example')
                                <p class="text-danger small mt-1 mb-0"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">Level Name</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-dark">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <select name="level_id" class="form-select border-start-0 ps-2">
                                    @foreach($levels as $l)
                                        <option value="{{ $l->id }}" {{ old('level_id', $lesson->level_id) == $l->id ? 'selected' : '' }}>
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
                                Update Lesson
                            </button>
                            <a href="{{ route('lessons.index') }}" class="btn btn-secondary px-4 rounded-3 fw-medium">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection