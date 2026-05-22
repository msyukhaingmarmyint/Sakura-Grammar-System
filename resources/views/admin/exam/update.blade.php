@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-7 col-md-9">

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-dark text-white text-center py-3 border-0">
                    <h4 class="mb-0 fw-bold">Edit Exam</h4>
                </div>

                <div class="card-body p-4 bg-white">
                    <form action="{{ route('exams.update', $exam->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">Title</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-dark">
                                    <i class="fa-solid fa-file-signature"></i>
                                </span>
                                <input type="text" name="title" class="form-control border-start-0 ps-2" value="{{ old('title', $exam->title) }}" required>
                            </div>
                            @error('title')
                                <p class="text-danger small mt-1 mb-0"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">Pass Mark</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-dark">
                                    <i class="fa-solid fa-award fa-lg"></i>
                                </span>
                                <input type="number" name="pass_mark" class="form-control border-start-0 ps-2" value="{{ old('pass_mark', $exam->pass_mark) }}" required>
                            </div>
                            @error('pass_mark')
                                <p class="text-danger small mt-1 mb-0"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-dark small fw-bold text-uppercase tracking-wider mb-1">Level Name</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-dark">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <select name="level_id" class="form-select border-start-0 ps-2" required>
                                    @foreach($levels as $l)
                                        <option value="{{ $l->id }}" {{ old('level_id', $exam->level_id) == $l->id ? 'selected' : '' }}>
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
                                Update Exam
                            </button>
                            <a href="{{ route('exams.index') }}" class="btn btn-secondary px-4 rounded-3 fw-medium">
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