@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-7 col-md-9">

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-dark text-white text-center py-3 border-0">
                    <h4 class="mb-0 fw-bold">Add New Exam</h4>
                </div>

                <div class="card-body p-4 bg-white">
                    <form action="{{ route('exams.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase tracking-wider mb-1">Exam Title</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="fa-solid fa-file-signature"></i>
                                </span>
                                <input type="text" name="title" class="form-control bg-light border-start-0 ps-2" value="{{ old('title') }}" placeholder="e.g. N4 Examination">
                            </div>
                            @error('title')
                                <p class="text-danger small mt-1 mb-0"><i class="fa-solid fa-circle-exclamation me-1"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase tracking-wider mb-1">Passing Score / Mark</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="fa-solid fa-award"></i>
                                </span>
                                <input type="text" name="pass_mark" class="form-control bg-light border-start-0 ps-2" value="{{ old('pass_mark') }}" placeholder="e.g. 50">
                            </div>
                            @error('pass_mark')
                                <p class="text-danger small mt-1 mb-0"><i class="fa-solid fa-circle-exclamation me-1"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold text-uppercase tracking-wider mb-1">Proficiency Level</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <select name="level_id" class="form-select bg-light border-start-0 ps-2">
                                    <option value="">--- Select Level ---</option>
                                    @foreach($levels as $l)
                                        <option value="{{ $l->id }}" {{ (string) old('level_id', $lesson->level_id ?? '') === (string) $l->id ? 'selected' : '' }}>
                                            {{ $l->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('level_id')
                                <p class="text-danger small mt-1 mb-0"><i class="fa-solid fa-circle-exclamation me-1"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center gap-2 mt-4">
                            <button type="submit" class="btn text-white px-4 rounded-3 fw-medium shadow-sm" style="background-color: #dd4c70;">
                                Create Exam
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
@endsection